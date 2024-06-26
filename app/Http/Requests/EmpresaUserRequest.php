<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaUserRequest extends FormRequest
{
    public function authorize(){
        // Aquí puedes añadir lógica para determinar si el usuario está autorizado a hacer esta solicitud.
        // Por ahora, simplemente permitiremos todas las solicitudes.
        return true;
    }

    public function rules()
    {
        return [
            'nombre_empresa' => 'required|string',
            'cif' => 'required|string',
            'imagen_empresa' => 'required|max:2048',
            'tel' => 'required',
            'tipo_empresa' => 'required',
            'sector_empresa' => 'required',
            'idioma' => 'required',
            'permite_notificaciones' => 'required',
            'acepto_condiciones' => 'required'
        ];
    }

}
