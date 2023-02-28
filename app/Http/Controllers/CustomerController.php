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
    // Session()->flash("message", "Customers has been created successfully");
    MeterReading::create([
      'customer_id' => $customer->id,
      'current_reading' => $request->current_meter_reading
    ]);
    $message = 'Dear customer, your water bill has been updated to 129.2. Amount to be paid is 1000 on Mpesa Paybill XXXXXX and account number' . $customer->meter_number . '. Thank you.';
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
  private function sendMessage($message, $recipients)
  {
    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_number = getenv("TWILIO_NUMBER");
    $client = new Client($account_sid, $auth_token);
    $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
  }
  private function sendMessage1($message, $recipients)
  {
    $curl = curl_init();
    $url = 'https://accounts.jambopay.com/auth/token';
    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt(
      $curl,
      CURLOPT_HTTPHEADER,
      array(
        'Content-Type: application/x-www-form-urlencoded',
      )
    );

    curl_setopt(
      $curl,
      CURLOPT_POSTFIELDS,
      http_build_query(
        array(
          'grant_type' => 'client_credentials',
          'client_id' => "qzuRm3UxXShEGUm2OHyFgHzkN1vTkG3kIVGN2z9TEBQ=",
          'client_secret' => "36f74f2b-0911-47a5-a61b-20bae94dd3f1gK2G2cWfmWFsjuF5oL8+woPUyD2AbJWx24YGjRi0Jm8="
        )
      )
    );

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);

    $token = json_decode($curl_response);
    curl_close($curl);

    $message = 'Your verification code is ' . $recipients;

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://swift.jambopay.co.ke/api/public/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode(
        array(
          "sender_name" => "PASANDA",
          "contact" => $recipients,
          "message" => $message,
          "callback" => "https://pasanda.com/sms/callback"
        )
      ),

      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token->access_token
      ),
    ));

    $responsePassanda = curl_exec($curl);
    curl_close($curl);
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
    $latest = MeterReading::whereId($customer->id)->latest()->first();
    $customer->update($request->validated());
    MeterReading::create([
      'customer_id' => $latest->id,
      'previous_reading' => $latest->current_reading,
      'current_reading' => $request->current_meter_reading,
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
