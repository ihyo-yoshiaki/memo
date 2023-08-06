<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormatRequest extends FormRequest
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
		'themeName' => 'required|string|max:50',
		//'tmpItems.*.name' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
	    return [
		    'themeName.required' => 'テーマのタイトルを入力してください',
		    'themeName.max' => '50文字以内の文字列を入力してください',
		    //'tmpItems.*.' => 'tmpItems',
		    //'tmpItems.*.name.nullable.string.max:50' => '50文字以内の文字列を入力してください',
	    ];
    }
}
