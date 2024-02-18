<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'user_id',
        'payment_id',
        'total_price'
    ];

    protected $primaryKey = 'invoice_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'payment_id');
    }
}
