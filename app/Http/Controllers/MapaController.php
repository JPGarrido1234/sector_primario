<?php

namespace App\Http\Controllers;


class MapaController extends Controller
{

    public function getVerMapaTodo(){
        return response()->json(['message' => 'getVerMapaTodo']);
    }

}
