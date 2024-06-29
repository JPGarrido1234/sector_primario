<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Clases\CTienda;
use App\Clases\CPosicion;


class MapaController extends Controller
{

    public function getVerMapaTodo($id_prov){
        $empresas = null;
        if($id_prov == -1){
            $empresas = Empresa::all();
        }else{
            $empresas = Empresa::where('ciudad_id', $id_prov)->get();
        }

        $empresas = $empresas->map(function($empresa){
            $posicion = new CPosicion($empresa->latitud, $empresa->longitud);
            $tienda = new CTienda($empresa->imagen_logo, $empresa->nombre, null, $empresa->telefono, null, $empresa->ubicacion, null, $posicion);
            return $tienda;
        });
        

        return response()->json(['message' => $empresas]);
    }

}
