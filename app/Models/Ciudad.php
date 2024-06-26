<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'provincias';

    protected $fillable = [
        'lon',
        'lat',
        'type',
        'geometry',
        'ccaa',
        'cod_ccaa',
        'provincia',
        'texto',
        'codigo'
    ];

    public function empresas(){
        return $this->hasMany(Empresa::class);
    }
}
