<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(Accounts::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
