<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarientOption extends Model
{
    use HasFactory;
    protected $table = 'variant_options';
    protected $fillable = [
        'varient_attribute_id',
        'option_name',
    ];
    public function varientAttribute()
    {
        return $this->belongsTo(VarientAttribute::class, 'varient_attribute_id');
    }
}
