<?php

namespace App\Clases;

class CPosicion
{
    public $latitud;
    public $longitud;

    public function __construct($latitud, $longitud)
    {
        $this->latitud = $latitud;
        $this->longitud = $longitud;
    }
}