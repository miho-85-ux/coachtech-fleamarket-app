<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'mimes:jpeg,png'],
            'condition' => ['required'],
            'price' => ['required', 'integer', 'min:0'],
            'categories' => ['required', 'array'],
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '商品名を入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は255文字以内で入力してください',
            'image.required' => '商品画像を選択してください',
            'image.mimes' => '商品画像はjpegまたはpng形式にしてください',
            'condition.required' => '商品状態は選択必須です',
            'price.required' => '金額を入力してください',
            'price.integer' => '金額は数字で入力してください',
            'price.min' => '金額は０円以上で入力してください',
            'categories.required' => 'カテゴリーを選択してください',
            ];
    }
}
