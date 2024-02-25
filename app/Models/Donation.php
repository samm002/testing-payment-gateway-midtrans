<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Donation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
      'name',
      'email',
      'donation_amount',
      'donation_message',
      'donation_date',
      'status',
      'payment_method',
      'campaign_id'
    ];
}
