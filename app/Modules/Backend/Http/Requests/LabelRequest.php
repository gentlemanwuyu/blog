<?php
namespace App\Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|max:32',
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
			'name.required' => "标签名不能为空",
			'name.max' => "标签名不能为超过:max个字符",
		];
	}
}
