<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseHead extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'expense_head_name',
        'description',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}