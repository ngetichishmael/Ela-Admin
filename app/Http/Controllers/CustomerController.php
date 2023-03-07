<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\MeterReading;
use AfricasTalking\SDK\AfricasTalking;
use Carbon\Carbon;

// use Twilio\Rest\Client;

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
      'amount' => $request->amount,
    ]);
    $names = explode(' ', $request->name);

    $amount = $this->amountPaid($request->amount, $request->type);
    $message1 = 'Welcome to Nyakanja co-op society. Kindly pay all your Bills through our Paybill 247247 Acc 714433#' . $customer->meter_number;
    $message2 = 'Dear' . $names[0] . ', Your current units is ' . $request->current_meter_reading . '. Current bill at ' . Carbon::now()->format('Y-m-d') . ' is Ksh.' . $amount . '  due ' . Carbon::now()->subDays(7)->format('Y-m-d') . '.Paybill 247247 Acc 714433#' . $customer->meter_number . '. Enquiries call 0726949264';
    $username = 'Nyakaja'; // use 'sandbox' for development in the test environment
    $apiKey   = '077d11d406762eb0c07b8fdda01cf69f6676482be521ead7a4bc20a4c18b4502'; // use your sandbox app API key for development in the test environment
    $AT       = new AfricasTalking($username, $apiKey);
    $sms      = $AT->sms();
    $sms->send([
      'to'      => $request->phone_number,
      'message' => $message2
    ]);
    $username = 'Nyakaja'; // use 'sandbox' for development in the test environment
    $apiKey   = '077d11d406762eb0c07b8fdda01cf69f6676482be521ead7a4bc20a4c18b4502'; // use your sandbox app API key for development in the test environment
    $AT       = new AfricasTalking($username, $apiKey);
    $sms      = $AT->sms();
    $sms->send([
      'to'      => $request->phone_number,
      'message' => $message1
    ]);
    return redirect()->route('customers');
  }
  public function amountPaid($amount, $type)
  {
    $payment = 0;
    switch ($type) {
      case 1:
        if ($amount < 11) {
          $payment = 400;
        } else if ($amount > 10 && $amount < 21) {
          $payment = ($amount * 45) - 50;
        } else if ($amount > 20 && $amount < 31) {
          $payment = ($amount * 50) - 150;
        } else if ($amount > 30 && $amount < 41) {
          $payment = ($amount * 55) - 200;
        } else if ($amount > 40 && $amount < 51) {
          $payment = ($amount * 60) - 250;
        } else {
          $payment = $amount * 80;
        }
        break;

      default:
        if ($amount < 11) {
          $payment = 500;
        } else if ($amount > 10 && $amount < 21) {
          $payment = ($amount * 60) - 100;
        } else if ($amount > 20 && $amount < 31) {
          $payment = ($amount * 70) - 300;
        } else if ($amount > 30 && $amount < 41) {
          $payment = ($amount * 80) - 600;
        } else if ($amount > 40 && $amount < 51) {
          $payment = ($amount * 90) - 1000;
        } else {
          $payment = $amount * 120;
        }
        break;
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
    $names = explode(' ', $request->name);
    $amount = $this->amountPaid($billing, $request->type);
    $message1 = 'Welcome to Nyakanja co-op society. Kindly pay all your Bills through our Paybill 247247 Acc 714433#' . $customer->meter_number;
    $message2 = 'Dear' . $names[0] . ', Your current units is ' . $request->current_meter_reading . '. Current bill at ' . Carbon::now()->format('Y-m-d') . ' is Ksh.' . $amount . '  due ' . Carbon::now()->subDays(7)->format('Y-m-d') . '.Paybill 247247 Acc 714433#' . $customer->meter_number . '. Enquiries call 0726949264';
    MeterReading::whereId($meter->id)->update(
      [
        'amount' => $amount,
      ]
    );
    $username = 'Nyakaja'; // use 'sandbox' for development in the test environment
    $apiKey   = '077d11d406762eb0c07b8fdda01cf69f6676482be521ead7a4bc20a4c18b4502'; // use your sandbox app API key for development in the test environment
    $AT       = new AfricasTalking($username, $apiKey);
    $sms      = $AT->sms();
    $sms->send([
      'to'      => $request->phone_number,
      'message' => $message1
    ]);
    $username = 'Nyakaja'; // use 'sandbox' for development in the test environment
    $apiKey   = '077d11d406762eb0c07b8fdda01cf69f6676482be521ead7a4bc20a4c18b4502'; // use your sandbox app API key for development in the test environment
    $AT       = new AfricasTalking($username, $apiKey);
    $sms      = $AT->sms();
    $sms->send([
      'to'      => $request->phone_number,
      'message' => $message2
    ]);
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
