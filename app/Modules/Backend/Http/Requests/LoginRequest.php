<?php
namespace App\Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username' => 'required',
			'password' => 'required',
			'captcha' => 'required|captcha',
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
			'username.required' => '请填写用户名',
			'password.required' => '请输入密码',
			'captcha.required' => '请输入验证码',
			'captcha.captcha' => '验证码错误',
		];
	}
}
