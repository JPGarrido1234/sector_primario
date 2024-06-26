<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';
    protected $fillable = [
        'actividad',
        'user_id',
        'empresa_id',
        'fecha'
    ];

}
