<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;

class ActividadController extends Controller
{

    public static function setActividad($actividad, $usuario_id, $empresa_id, $fecha){
        $actividadClass = new Actividad;
        $actividadClass->actividad = $actividad;
        $actividadClass->user_id = $usuario_id;
        $actividadClass->empresa_id = $empresa_id;
        $actividadClass->fecha = $fecha;
        $actividadClass->save();
    }

    public static function getActividades(){
        $actividades = Actividad::all();
        return response()->json($actividades);
    }
}
