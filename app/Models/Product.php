<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected  $fillable = [
        'code',
        'name',
        'category',
        'tax',
        'primary_unit',
        'hscode',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function uom()
    {
        return $this->belongsTo(UOM::class, 'primary_unit');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function primaryUnit()
    {
        return $this->belongsTo(UOM::class);
    }
}
