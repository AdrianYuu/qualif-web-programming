<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'name'
    ];

    protected $primaryKey = 'payment_id';

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'payment_id', 'payment_id');
    }
}
