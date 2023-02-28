<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('meter_readings', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Customer::class);
      $table->string('previous_reading')->default(0);
      $table->string('current_reading')->default(0);
      $table->string('amount')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('meter_readings');
  }
};
