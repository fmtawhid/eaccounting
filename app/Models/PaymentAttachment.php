<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'file_path',
        'file_name',
        'file_type'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
