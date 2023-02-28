<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\MeterReading;
use Twilio\Rest\Client;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('livewire.customer.layout');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('livewire.customer.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreCustomerRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCustomerRequest $request)
  {
    $customer = Customer::create($request->validated());
    MeterReading::create([
      'customer_id' => $customer->id,
      'current_reading' => $request->current_meter_reading,
    ]);
    $message = 'You have been successfully added to Nyakaja Company Billing System. Your meter number is ' . $customer->meter_number . ' and your current meter reading is ' . $request->current_meter_reading . '. Thank you.';
    $sid    = "AC97e6460dd5677dab4c3ea23181221aac";
    $token  = "421fe8314e382ce36be3b4bdf49dc5d4";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create(
        $request->phone_number, // to
        array(
          "from" => "+19283963106",
          "body" => $message
        )
      );

    return redirect()->route('customers');
  }
  public function amountPaid($amount)
  {
    $payment = 0;
    if ($amount < 10) {
      $payment = $amount * 30;
    } else if ($amount > 9 && $amount < 21) {
      $payment = $amount * 40;
    } else {
      $payment = $amount * 50;
    }
    return $payment;
  }
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Customer  $customer
   * @return \Illuminate\Http\Response
   */
  public function show(Customer $customer)
  {
    return view('livewire.customer.view', [
      'customer' => $customer
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Customer  $customer
   * @return \Illuminate\Http\Response
   */
  public function edit(Customer $customer)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCustomerRequest  $request
   * @param  \App\Models\Customer  $customer
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCustomerRequest $request, Customer $customer)
  {
    $latest = MeterReading::where('customer_id', $customer->id)->orderBy('id', 'DESC')->first();
    $customer->update($request->validated());
    $meter = MeterReading::create([
      'customer_id' => $customer->id,
      'previous_reading' => $latest->current_reading,
      'current_reading' => $request->current_meter_reading,
    ]);

    $LastRecord = MeterReading::where('customer_id', $customer->id)->orderBy('id', 'desc')->first();
    $billing = (float)$LastRecord->current_reading - (float)$LastRecord->previous_reading;
    $amount = $this->amountPaid($billing);
    $message = 'Dear customer, your water bill has been updated to ' . $LastRecord->current_reading . ' . Amount to be paid is ' . $amount . ' on Mpesa Paybill XXXXXX and account number ' . $customer->meter_number . '. Thank you.';
    MeterReading::whereId($meter->id)->update(
      [
        'amount' => $amount,
      ]
    );
    $sid    = "AC97e6460dd5677dab4c3ea23181221aac";
    $token  = "421fe8314e382ce36be3b4bdf49dc5d4";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create(
        $request->phone_number, // to
        array(
          "from" => "+19283963106",
          "body" => $message
        )
      );
    return redirect()->route('customers');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Customer  $customer
   * @return \Illuminate\Http\Response
   */
  public function destroy(Customer $customer)
  {
    //
  }
}
