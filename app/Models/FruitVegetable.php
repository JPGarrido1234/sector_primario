<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FruitVegetable extends Model
{
    use HasFactory;
    protected $table = 'fruit_vegetable';
    protected $fillable = ['name', 'image_url', 'tipo', 'descripcion', 'precio_unidad'];

    public function productosAgricultura(){
        return $this->hasMany(ProductosAgricultura::class);
    }
}
