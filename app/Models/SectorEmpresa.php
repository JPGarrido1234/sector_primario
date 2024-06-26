<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorEmpresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_corto',
        'nombre'
    ];

    public function empresas(){
        return $this->hasMany(Empresa::class);
    }
}
