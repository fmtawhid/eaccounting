<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brance extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description'];
    public function payments()
{
    return $this->hasMany(Payment::class);
}

public function expenses()
{
    return $this->hasMany(Expense::class);
}
}


