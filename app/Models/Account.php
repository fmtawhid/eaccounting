<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'number', 'brance_id', 'amount', 'note'];

    public function brance()
    {
        return $this->belongsTo(Brance::class);
    }
}