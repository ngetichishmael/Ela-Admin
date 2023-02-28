<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
  use HasFactory;
  protected $guarded = [""];
  /**
   * Get all of the MeterReading for the Customer
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function MeterReading(): HasMany
  {
    return $this->hasMany(MeterReading::class);
  }
  /**
   * Get the LatestRecord associated with the Customer
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function LatestRecord(): HasOne
  {
    return $this->hasOne(MeterReading::class)->latest();
  }
}
