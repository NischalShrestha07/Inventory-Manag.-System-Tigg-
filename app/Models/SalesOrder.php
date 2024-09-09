<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'orderno',
        'referenceno',
        'date',
        'deliverydate',
        'stage',

    ];
    public function hello()
    {
        return $this->belongsTo(Customer::class, 'name');
    }
}
