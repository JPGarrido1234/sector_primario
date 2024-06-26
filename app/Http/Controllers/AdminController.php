<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoEmpresa;
use App\Models\SectorEmpresa;
use App\Models\Idioma;
use App\Models\Ciudad;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmpresaUserRequest;
use Yajra\DataTables\DataTables;
use App\Models\FruitVegetable;
use App\Models\ProductosAgricultura;
use Carbon\Carbon;
use GuzzleHttp\Client;

class UbicacionACoordenadas{
    public $user_id;
    public $longitud;
    public $latitud;

    public function __construct($user_id, $longitud, $latitud){
        $this->user_id = $user_id;
        $this->longitud = $longitud;
        $this->latitud = $latitud;
    }
}

class AdminController extends Controller
{
    public function dashboard(){
        $users_chart_count = UtilController::getChart1();
        return view('admin.dashboard', compact('users_chart_count'));
    }

    public function verMapa(){
        return view('admin.mapa');
    }

    public function verListaEmpresas(){
        return view('admin.lista_empresas');
    }

    public function showFormNewCompany(){
        $empresa = null;
        $tipo_empresas = TipoEmpresa::all();
        $sector_empresas = SectorEmpresa::all();
        $idiomas = Idioma::all();
        $provincias = Ciudad::orderBy('provincia', 'asc')->get();
        $user = User::find(Auth::user()->id);
        $empresa_user = Empresa::where('user_id', Auth::user()->id)->first();


        return view('admin.formularios.new_company', compact('tipo_empresas', 'sector_empresas', 'idiomas', 'provincias', 'user', 'empresa_user'));
    }

    public function showFormNewProduct(){
        $productos_disponibles = null;
        $productos_disponibles = Auth::user()->productosAgricultura->load('fruitVegetable');
        return view('admin.formularios.nuevo_producto', compact('productos_disponibles'));
    }

    public function verProducto($id){
        $producto = ProductosAgricultura::find($id);
        return view('admin.formularios.ver_producto', compact('producto'));
    }

    public function showFormSolicitarProducto($id){
        $producto = ProductosAgricultura::find($id);
        return view('admin.formularios.solicitar_producto', compact('producto'));
    }

    public function newCompany(EmpresaUserRequest $request){

        $validator = Validator::make($request->all(), [
            'nombre_empresa' => 'required|min:3',
            'cif' => 'required',
            'imagen_logo' => 'required|max:2048',
            'tel' => 'required',
            'tipo_empresa' => 'required',
            'sector_empresa' => 'required',
            'idioma' => 'required',
            'permite_notificaciones' => 'required',
            'acepto_condiciones' => 'required'
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $imagenLogo = $request->file('imagen_logo');
        $user = User::find($request->user_id);
        if($user){
            $user->permite_notificacion = $request->permite_notificaciones == 'on' ? 1 : 0;
            $user->save();
        }
        //Carpeta donde guardar imagen
        $name = trim($user->name);
        // Convertir a mayúsculas
        $name = mb_strtoupper($name, 'UTF-8');
        // Reemplazar los caracteres acentuados
        $unwanted_array = array('Á'=>'A', 'É'=>'E', 'Í'=>'I', 'Ó'=>'O', 'Ú'=>'U', 'Ü'=>'U', 'á'=>'A', 'é'=>'E', 'í'=>'I', 'ó'=>'O', 'ú'=>'U', 'ü'=>'U');
        $clave_carpeta = strtr($name, $unwanted_array);
        $carpeta = 'public/empresas/' . $clave_carpeta;
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $imagenLogo->storeAs($carpeta, 'logo_empresa.' . $imagenLogo->getClientOriginalExtension());
        $empresa = $user->empresa;
        if($empresa){
            $empresa->nombre = $request->nombre_empresa;
            $empresa->cif = $request->cif;
            $empresa->imagen = $carpeta . '/logo_empresa.' . $imagenLogo->getClientOriginalExtension();
            $empresa->telefono = $request->tel;
            $empresa->tipo_empresa_id = $request->tipo_empresa;
            $empresa->id_sector_empresa = $request->sector_empresa;
            $empresa->idioma_id = $request->idioma;
            $empresa->ciudad_id = $request->ciudad;
            $empresa->web = $request->url_web;
            $empresa->descripcion = $request->descripcion;
            $empresa->acepto_condiciones = $request->acepto_condiciones == 'on' ? 1 : 0;
            $empresa->validado_admin = 1;
            $empresa->save();
            ActividadController::setActividad('Alta empresa para usuario', $user->id, $empresa->id, now());
            return redirect('admin/dashboard')->with('success', trans('registro_usuario_ok'));
        }
        return redirect('admin/new-company-form')->with('error', trans('registro_usuario_ko'));
    }

    public function getListaEmpresas(){
        $empresas = Empresa::select(['id', 'nombre', 'cif', 'imagen_logo', 'telefono', 'web', 'activo', 'acepto_condiciones', 'tipo_empresa_id', 'sector_empresa_id', 'created_at']);
        return DataTables::of($empresas)
        ->addColumn('tipo', function($empresa){
            return $empresa->tipoEmpresa->tipo_nombre ?? '---';
        })
        ->addColumn('sector', function($empresa){
            return $empresa->sectorEmpresa->nombre ?? '---';
        })
        ->addColumn('circulo', function($empresa){
            if($empresa->activo == 1){
                return '<span class="badge badge-success">SI</span>';
            }else if($empresa->activo == 0){
                return '<span class="badge badge-danger">NO</span>';
            }else{
                return '<span class="badge badge-warning">Pendiente</span>';
            }
        })
        ->addColumn('url_imagen', function($empresa){
            //$empresa->imagen_logo = explode('/',$empresa->imagen_logo);
             return isset($empresa->imagen_logo) ? $empresa->imagen_logo : 'default';
        })
        ->addColumn('condiciones', function($empresa){
            if($empresa->acepto_condiciones == 1){
                return '<span class="badge badge-success">SI</span>';
            }else if($empresa->acepto_condiciones == 0){
                return '<span class="badge badge-danger">NO</span>';
            }else{
                return '<span class="badge badge-warning">Pendiente</span>';
            }
        })
        ->addColumn('acciones', function($empresa){
            return '<a href="'.route('admin.editar-empresa', $empresa->id).'" class="btn btn-primary btn-sm">Editar</a>'
            . ' <a href="'.route('admin.eliminar-empresa', $empresa->id).'" class="btn btn-danger btn-sm ml-2">Eliminar</a>';
        })
        ->rawColumns(['tipo', 'sector', 'circulo', 'url_imagen', 'condiciones', 'acciones'])
        ->make(true);
    }

    public function editarEmpresa($id){
        $empresa = Empresa::find($id);
        $tipo_empresas = TipoEmpresa::all();
        $sector_empresas = SectorEmpresa::all();
        $idiomas = Idioma::all();
        $provincias = Ciudad::orderBy('provincia', 'asc')->get();
        $user = User::find($empresa->user_id);
        //return view('admin.formularios.editar_empresa', compact('empresa', 'tipo_empresas', 'sector_empresas', 'idiomas', 'provincias', 'user'));
    }

    public function eliminarEmpresa($id){
        $empresa = Empresa::find($id);
        $empresa->delete();
        return redirect('admin/lista-empresas')->with('success', 'Empresa eliminada correctamente');
    }

    public function guardaUbicacion(Request $request){
        try {
            $empresa = Empresa::where('user_id', Auth()->user()->id)->first();
            if (!$empresa) {
                return response()->json(['status' => 'error', 'message' => 'Empresa no encontrada'], 404);
            }
            $empresa->update(['ubicacion' => $request->ubicacion]);
            return response()->json(['status' => 'ok', 'data' => $request->ubicacion]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Hubo un error al actualizar la ubicación'], 500);
        }
    }

    public function getProductosAdmin(Request $request){
        $arrayElegidos = [];
        $opcion = $request->frutas == 1 ? 'fruta' : 'vegetal';
        $fruitVegetableUserId = Auth::user()->productosAgricultura->load('fruitVegetable');
        foreach ($fruitVegetableUserId as $value) {
            array_push($arrayElegidos, $value->fruitVegetable->id);
        }

        $res = FruitVegetable::where('tipo', $opcion)->whereNotIn('id', $arrayElegidos)->get();
        return response()->json(['res' => $res]);
    }

    public function newProduct(Request $request){
        $fruit_vegetable_id = $request->opcion;
        $peso_pieza = $request->peso_pieza;
        $precio_pieza = $request->precio_pieza;
        $en_venta = $request->en_venta;
        $stock = $request->stock;
        $fecha_cosecha = $request->fecha_cosecha;

        try{
            $productosAgricultura = new ProductosAgricultura();
            $productosAgricultura->user_id = Auth::user()->id;
            $productosAgricultura->fruit_vegetable_id = $fruit_vegetable_id;
            $productosAgricultura->peso = $peso_pieza;
            $productosAgricultura->precio_unidad = $precio_pieza;
            $productosAgricultura->cantidad_stock = $stock;
            $productosAgricultura->cantidad_en_venta = $en_venta;
            $productosAgricultura->fecha_cosecha = $fecha_cosecha;
            $productosAgricultura->fecha_venta = Carbon::now();
            $productosAgricultura->save();

            ActividadController::setActividad('Alta producto nuevo para empresa', Auth::user()->id, Auth::user()->empresa->id, now());
            return redirect('admin/producto')->with('success', 'Producto creado correctamente');
        } catch (\Exception $e) {
            return redirect('admin/producto')->with('error', 'Hubo un error al crear el producto: ' . $e->getMessage());
        }
    }

    public function verListaProductos(){
        $productos = null;
        $provincia = Auth::user()->empresa->ciudad->provincia;
        $miUbicacion = null;
        $httpClient = new Client();
        $accessToken = env('MAPBOX_API_KEY'); // Reemplaza esto con tu token de acceso de Mapbox
        $empresas = Empresa::where('ciudad_id', Auth::user()->empresa->ciudad->id)->get();
        $ubicaciones = [];

        foreach ($empresas as $empresa) {
            $content = null;
            if($empresa->user_id != Auth::user()->id){
                $address = $empresa->ubicacion; // Asegúrate de que 'ubicacion' es el nombre correcto del campo
                $response = $httpClient->get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json?access_token={$accessToken}");
                $body = $response->getBody();
                $content = json_decode($body->getContents());
                if(isset($content->features[0])){
                    $coordinates = $content->features[0]->geometry->coordinates;
                    $longitude = $coordinates[0];
                    $latitude = $coordinates[1];
                    array_push($ubicaciones, new UbicacionACoordenadas($empresa->user_id, $longitude, $latitude));
                }
            }
        }

        $productos = ProductosAgricultura::whereHas('User', function ($query) use ($provincia) {
            $query->whereHas('Empresa', function ($query) use ($provincia) {
                $query->whereHas('Ciudad', function ($query) use ($provincia) {
                    $query->where('provincia', $provincia);
                });
            });
        })->get();

        foreach ($productos as $producto) {
            foreach ($ubicaciones as $ubicacion) {
                if($producto->user_id == $ubicacion->user_id){
                    $producto->User->Empresa->lonlat = $ubicacion->longitud.' '.$ubicacion->latitud;
                }
            }
        }
        return view('admin.lista_productos', compact('productos'));
    }

    public static function getMiUbicacion(){
        $httpClient = new Client();
        $accessToken = env('MAPBOX_API_KEY'); // Reemplaza esto con tu token de acceso de Mapbox
        $miUbicacion = Auth::user()->empresa->ubicacion;
        $response = $httpClient->get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$miUbicacion}.json?access_token={$accessToken}");
        $body = $response->getBody();
        $content = json_decode($body->getContents());
        if(isset($content->features[0])){
            $coordinates = $content->features[0]->geometry->coordinates;
            $longitude = $coordinates[0];
            $latitude = $coordinates[1];
            $miUbicacion = $longitude.' '.$latitude;
        }

        return $miUbicacion;
    }

}
