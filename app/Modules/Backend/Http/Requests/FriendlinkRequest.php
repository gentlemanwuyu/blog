<?php
namespace App\Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FriendlinkRequest extends FormRequest
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
			'link' => 'required',
			'desc' => 'required|max:64',
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
			'name.required' => "网站名称不能为空",
			'name.max' => "网站名称不能为超过:max个字符",
			'link.required' => "链接不能为空",
			'desc.required' => "简介不能为空",
			'desc.max' => "简介不能为超过:max个字符",
		];
	}
}
