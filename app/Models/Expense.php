<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'expense_head_id',
        'brance_id',    // Add branch id here
        'account_id',   // Add account id here
        'name',
        'invoice_no',
        'date',
        'amount',
        'note',
    ];

    /**
     * Get the expense head that owns the expense.
     */
    public function expenseHead()
    {
        return $this->belongsTo(ExpenseHead::class);
    }

    /**
     * Get the branch that owns the expense.
     */
    // In Expense model
    public function brance()
    {
        return $this->belongsTo(Brance::class, 'brance_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }


    /**
     * Get the attachments for the expense.
     */
    public function attachments()
    {
        return $this->hasMany(ExpenseAttachment::class);
    }
}
