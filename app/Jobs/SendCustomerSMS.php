<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendCustomerSMS implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  protected $request;

  /**
   * Create a new job instance.
   *
   * @param  object  $request
   * @return void
   */
  public function __construct($request)
  {
    $this->request = $request;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $customers = Customer::all();
    foreach ($customers as $customer) {
      dispatch(new SendSMS($customer, $this->request->text));
    }
  }
}