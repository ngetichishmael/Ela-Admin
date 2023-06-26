<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\MeterReading;
use App\Helpers\SMS;
use Carbon\Carbon;

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
    $message1 = 'Welcome to Nyakanja co-op society. Kindly pay all your Bills through our Paybill 247247 Acc 714433#' . $customer->meter_number;
    $message2 = 'Dear ' . $names[0] . ', Your current units is ' . $request->current_meter_reading . '. Current bill at ' . Carbon::now()->format('Y-m-d') . ' is Ksh.' . $request->amount . '  due ' . Carbon::now()->addDays(7)->format('Y-m-d') . '.Paybill 247247 Acc 714433#' . $customer->meter_number . '. Enquiries call 0726949264';
    (new SMS())($request->phone_number, $message1);
    (new SMS())($request->phone_number, $message2);
    return redirect()->route('customers');
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
    MeterReading::create([
      'customer_id' => $customer->id,
      'previous_reading' => $latest->current_reading,
      'current_reading' => $request->current_meter_reading,
      'amount' => $request->amount
    ]);
    $names = explode(' ', $request->name);
    $message2 = 'Dear ' . $names[0] . ', Your current units is ' . $request->current_meter_reading . '. Current bill at ' . Carbon::now()->format('Y-m-d') . ' is Ksh.' . $request->amount . '  due ' . Carbon::now()->addDays(7)->format('Y-m-d') . '.Paybill 247247 Acc 714433#' . $customer->meter_number . '. Enquiries call 0703216110';
    (new SMS())($request->phone_number, $message2);
    return redirect()->back()->with('success', 'Data saved successfully');
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
