<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosAgricultura extends Model
{
    use HasFactory;
    protected $table = 'productos_agricultura';
    protected $fillable = ['user_id', 'fruit_vegetable_id', 'peso', 'precio_unidad', 'precio_total', 'cantidad_stock', 'cantidad_en_venta', 'fecha_cosecha', 'fecha_venta', 'estado', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function fruitVegetable(){
        return $this->belongsTo(FruitVegetable::class);
    }
}
