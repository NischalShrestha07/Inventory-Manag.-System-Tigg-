<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarientAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'option',
    ];
    public function options()
    {
        return $this->hasMany(VarientOption::class, 'varient_attribute_id');
    }
}
