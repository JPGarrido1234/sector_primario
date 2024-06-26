<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use App\Clases\CTienda;
use App\Clases\Posicion;
use App\Models\UserRole; // Add this line
use Illuminate\Support\Facades\Storage;


class ApiController extends Controller
{
    public function login(Request $request){
        return response()->json(['message' => 'login']);
    }

    public function registro(Request $request){
        return response()->json(['message' => 'registro']);
    }

    public function valida_email(Request $request){
        return response()->json(['message' => 'valida_email']);
    }

    public function destroy(Request $request){
        return response()->json(['message' => 'destroy']);
    }

    public function alta_tienda(Request $request){
        $foto = null;
        $calle = null;
        $cp = null;

        $calle = $request->input('calle');
        if($request->input('cp') != null){
            $cp = $request->input('cp');
        }else{
            $cp = $this->obtenerCP($calle);
        }

        if($cp == false){
            return response()->json(['response' => 'error', 'message' => 'No se ha podido obtener el código postal']);
        }

        do {
            $codigo = mt_rand(100000, 999999);
        } while (Empresa::where('cod_empresa', $codigo)->exists());

        $foto = $this->guardarImagen($request, $codigo);
        $tienda = new CTienda(
            $foto,
            $request->input('nombre_tienda'),
            $request->input('nombre_persona'),
            $request->input('tlf'),
            $request->input('email'),
            $calle,
            $cp,
            new Posicion(
                $request->input('posicion.latitud'),
                $request->input('posicion.longitud')
            )
        );

        if($cp != null){
            $user = User::where('email', $tienda->email)->first();
            if($user == null){
                $user = new User();
                $user->name = $tienda->nombre_persona;
                $user->email = $tienda->email;
                $user->permite_notificacion = 0;
                $user->acceso = 0;
                $user->save();

                $user_role = new UserRole;
                $user_role->user_id = $user->id;
                $user_role->role_id = 2; //Usuario normal
                $user_role->save();

                $empresa = new Empresa;
                $empresa->user_id = $user->id;
                $empresa->nombre = $tienda->nombre_tienda;
                $empresa->activo = 0;
                $empresa->ubicacion = $tienda->calle;
                $empresa->telefono = $tienda->tlf;
                $empresa->validado_admin = 0;
                $empresa->acepto_condiciones = 0;
                $empresa->tipo_empresa_id = 1;
                $empresa->sector_empresa_id = 3;
                $empresa->idioma_id = 1;
                $empresa->cod_empresa = $codigo;
                $empresa->imagen_empresa = $tienda->foto;
                $user->empresa()->save($empresa);

            }else{
                return response()->json(['response' => 'error', 'message' => 'El usuario ya existe']);
            }
        }

        return response()->json(['response' => 'success','message' => $tienda]);
    }

    public function obtenerCP($direccion) {
        $apiKey = 'AIzaSyBrvvChhGa2aOap6s79hEg6la2KLoLW--A';
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($direccion)."&key=".$apiKey;

        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);

        if($resp['status']=='OK'){
            foreach($resp['results'][0]['address_components'] as $component){
                if(in_array('postal_code', $component['types'])){
                    return $component['long_name'];
                }
            }
        }

        return false;
    }

    public function guardarImagen(Request $request, $codigo_empresa) {
        $imagen = $request->file('foto');
        if($imagen == null){
            return null;
        }
        $carpeta = 'public/empresas/' . strval($codigo_empresa);

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $nombreImagen = 'img_empresa.' . $imagen->getClientOriginalExtension();
        $imagen->storeAs($carpeta, $nombreImagen);

        $url = Storage::url($carpeta . '/' . $nombreImagen);

        return $url;
    }

    public function verMapaTodo(){
        return response()->json(['message' => 'verMapaTodo']);
    }
}
