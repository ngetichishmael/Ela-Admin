<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required',
      'phone_number' => 'required|numeric',
      'meter_number' => 'required',
      'id_number' => 'required|numeric',
      'current_meter_reading' => 'required',
    ];
  }
  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'name.required' => 'A customer is required',
      'phone_number.required' => 'A phone number is required',
      'phone_number.numeric' => 'A phone number must be a number',
      'meter_number.required' => 'A meter number is required',
      'id_number.required' => 'A id number is required',
      'id_number.numeric' => 'A id number must be a number',
      'current_meter_reading.required' => 'A message is required',
    ];
  }
}
