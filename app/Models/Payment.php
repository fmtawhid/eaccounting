<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'reciept_no',
        'date',
        'name',
        'purpose_id',
        'amount',
        'amount_in_words',
        'brance_id',      // ✅ নতুন ফিল্ড
        'account_id',     // ✅ নতুন ফিল্ড
    ];

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
    }

    public function attachments()
    {
        return $this->hasMany(PaymentAttachment::class);
    }

    public function brance()
    {
        return $this->belongsTo(Brance::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
