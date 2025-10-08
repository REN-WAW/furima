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
            'product_name' => 'required',
            'product_description' => 'required | max:255',
            'product_image' => 'required | image | mimes:jpeg,png',
            'product_category' => 'required',
            'product_condition' => 'required',
            'product_price' => 'required | integer | min:0',
        ];
    }
    public function messages():array
    {
        return [
            'product_name.required' => '商品名を入力してください',
            'product_description.required' => '商品説明を入力してください',
            'product_description.max' => '255文字以内で入力してください',
            'product_image.required' => '商品画像をアップロードしてください',
            'profile_image.mimes:jpeg,png' => '「jpeg」または「png」形式でアップロードしてください',
            'product_category.required' => '選択してください',
            'product_condition.required' => '選択してください',
            'product_price.required' => '価格を入力してください',
            'product_price.integer' => '数字で入力してください',
            'product_price.min' => '0円以上で入力してください',
        ];
    }
}
