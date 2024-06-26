<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEmpresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_nombre'
    ];

    public function empresas(){
        return $this->hasMany(Empresa::class);
    }
}
