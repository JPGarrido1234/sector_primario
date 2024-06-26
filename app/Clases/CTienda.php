<?php

namespace App\Clases;

class CTienda
{
    public $foto;
    public $nombre_tienda;
    public $nombre_persona;
    public $tlf;
    public $email;
    public $calle;
    public $cp;
    public $posicion;

    public function __construct($foto, $nombre_tienda, $nombre_persona, $tlf, $email, $calle, $cp, $posicion)
    {
        $this->foto = $foto;
        $this->nombre_tienda = $nombre_tienda;
        $this->nombre_persona = $nombre_persona;
        $this->tlf = $tlf;
        $this->email = $email;
        $this->calle = $calle;
        $this->cp = $cp;
        $this->posicion = $posicion;
    }
}

class Posicion
{
    public $latitud;
    public $longitud;

    public function __construct($latitud, $longitud)
    {
        $this->latitud = $latitud;
        $this->longitud = $longitud;
    }
}
