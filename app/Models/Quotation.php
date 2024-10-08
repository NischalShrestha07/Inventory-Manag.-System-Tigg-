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


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_name');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_name');
    }
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class)->withPivot('quantity', 'amount');
    // }
}
