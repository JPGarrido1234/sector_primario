<?php 

namespace App\Clases;

class CUbicacionACoordenadas{
    public $user_id;
    public $longitud;
    public $latitud;

    public function __construct($user_id, $longitud, $latitud){
        $this->user_id = $user_id;
        $this->longitud = $longitud;
        $this->latitud = $latitud;
    }
}