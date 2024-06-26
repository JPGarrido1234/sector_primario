<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang',
        'idioma'
    ];

    public function empresas(){
        return $this->hasMany(Empresa::class);
    }
}
