<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public $lonlat = null;
    protected $fillable = [
        'user_id',
        'cod_empresa',
        'nombre',
        'imagen',
        'web',
        'ciudad',
        'cif',
        'ubicacion',
        'validado_admin',
        'activo',
        'tipo_empresa_id',
        'id_categoria_empresa',
        'descripcion'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tipoEmpresa(){
        return $this->belongsTo(TipoEmpresa::class, 'tipo_empresa_id', 'id');
    }

    public function sectorEmpresa(){
        return $this->belongsTo(SectorEmpresa::class);
    }

    public function idioma(){
        return $this->belongsTo(Idioma::class);
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
}
