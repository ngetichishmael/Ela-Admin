<?php

namespace App\Jobs;

use App\Helpers\SMS;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMS implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $customer;
  protected $text;

  /**
   * Create a new job instance.
   *
   * @param  Customer  $customer
   * @param  string  $text
   * @return void
   */
  public function __construct(Customer $customer, string $text)
  {
    $this->customer = $customer;
    $this->text = $text;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    (new SMS())($this->customer->phone_number, $this->text);
  }
}
