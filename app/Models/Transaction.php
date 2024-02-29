<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
      'donation_id',
      'status',
      'payment_method',
      'transaction_success_date',
    ];

    public function donation()
    {
      return $this->belongsTo(Donation::class);
    }
}
