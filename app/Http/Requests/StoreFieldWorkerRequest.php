<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFieldWorkerRequest extends FormRequest
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
      'id_number' => 'required|numeric',
      'phone_number' => 'required',
    ];
  }
  public function messages()
  {
    return [
      'name.required' => 'A customer is required',
      'id_number.required' => 'A id number is required',
      'id_number.numeric' => 'A id number must be a number',
      'phone_number.required' => 'A phone number is required',
    ];
  }
}
