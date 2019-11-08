<?php
namespace App\Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required|max:64',
			'keywords' => 'required|max:300',
			'content' => 'required',
			'summary' => 'required|max:300',
			'category_id' => 'required',
			'labels' => 'required',
			'summary_image_url' => 'required|max:1024',
			'summary_image_desc' => 'required|max:300',
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
			'title.required' => "标题不能为空",
			'title.max' => "标题不能为超过:max个字符",
			'keywords.required' => "关键词不能为空",
			'keywords.max' => "关键词不能为超过:max个字符",
			'content.required' => "内容不能为空",
			'summary.required' => "摘要不能为空",
			'summary.max' => "摘要不能为超过:max个字符",
			'category_id.required' => "请选择分类",
			'labels.required' => "请至少勾选1个标签",
			'summary_image_url.required' => "请上传/选择摘要图片",
			'summary_image_url.max' => "摘要图片url不能为超过:max个字符",
			'summary_image_desc.required' => "摘要图片描述不能为空",
			'summary_image_desc.max' => "摘要图片描述不能为超过:max个字符",
		];
	}
}
