<?php
namespace App\Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitorRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'url' => 'required',
			'device' => 'max:255',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	public function messages()
	{
		return [
			'url.required' => "Url can\'t be empty.",
			'device.max' => "The length of device can\'t be more than :max letters.",
		];
	}
}
