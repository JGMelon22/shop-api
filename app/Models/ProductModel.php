<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $fillable = [
        "name",
        "description",
        "skuNumber",
        "category",
        "supplier",
        "numberAvailable",
        "price",
    ];
}
