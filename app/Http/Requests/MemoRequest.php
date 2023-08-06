<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemoRequest extends FormRequest
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
		'memo.title' => 'required|string|max:50',
		'newTag.*' => 'nullable|string|max:50',
		'memo.text.*' => 'nullable|string|max:16384'
        ];
    }

    public function messages()
    {
	    return [
		    'memo.title' => "新規メモのタイトルを最初に入力してください",
		    //'oldTagId.required_without_all' => 'タグを選択してください',
		    'newTag.*' => "50文字以内の文字列を入力してください",
		    'memo.text.*' => "16384字以内の文字列を入力してください",
	    ];
    }
}
