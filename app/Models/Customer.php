<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'address',
        'code',
        'pan',
        'phoneno',
        'email',
        'group',
        'cterms',
        'climit',

    ];
    public function product()
    {
        return $this->belongsTo(InvenAdjustment::class);
    }
}
