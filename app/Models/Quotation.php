<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'date',
        'expiry_date',
        'currency',
        'credit_notes',
        'product_name',
        'terms'
    ];


    public function quotation()
    {
        return $this->belongsTo(Product::class, 'customer_name');
    }
}
