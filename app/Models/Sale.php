<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['total', 'pago_con', 'cambio', 'metodo_pago'];

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }
}