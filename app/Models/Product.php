<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


protected $fillable = [
    'nombre',
    'codigo_barras',
    'precio',
    'stock',
    'imagen', // <--- Asegúrate de tener este campo aquí
];
}