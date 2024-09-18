<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarientProduct extends Model
{
    use HasFactory;
    public function primaryUnit()
    {
        return $this->belongsTo(UOM::class);
    }
}
