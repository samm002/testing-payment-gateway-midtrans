<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;

  class Campaign extends Model
  {
      use HasFactory;

      protected $fillable = [
        'name',
        'type',
        'current_donation',
        'target_donation',
        'start_date',
        'end_date',
        'description',
        'photo',
      ];

      public function donations()
      {
        return $this->hasMany(Donation::class);
      }
  }
