<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'expense_id',
        'file_path',
        'file_name',
        'file_type'
    ];

    /**
     * Get the expense that owns the attachment.
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
