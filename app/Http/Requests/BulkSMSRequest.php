<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkSMSRequest extends FormRequest
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

  public function rules()
  {
    return [
      'text' => 'required|max:159',
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
      'text.required' => 'The bulk message to be sent is required',
      'text.max' => 'The bulk message to be sent cannot exceed 160 characters',
    ];
  }
}
