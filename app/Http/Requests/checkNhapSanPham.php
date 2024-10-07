<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class checkNhapSanPham extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'gia_km' => 'required|integer|min:0|lt:gia',
            'gia' => 'required|integer|min:0',
            'so_luong.*' => 'required|integer|min:0',
            'id_dm' => 'required|bail|min:1',
        ];
    }
    public function messages()
    {
        return [
            'gia_km.required' => '*Bắt buộc',
            'gia_km.integer' => 'Giá Khuyến Mãi không được có kí tự đặt biệt',
            'gia_km.min' => 'Giá Khuyến Mãi không được nhỏ hơn 0',
            'gia_km.less_than' => 'Giá Khuyến Mãi phải nhỏ hơn Giá Gốc',
            'gia.required' => '*Bắt buộc',
            'gia.integer' => 'Giá không được có kí tự đặc biệt',
            'gia.min' => 'Giá không được nhỏ hơn 0',
            'so_luong.*.required' => '*Bắt buộc',
            'so_luong.*.integer' => 'Số lượng không được có kí tự đặc biệt',
            'so_luong.*.min' => 'Số lượng không được nhỏ hơn 0',
            'id_dm.required' => '*Bắt buộc',
            'id_dm.min' => 'Chọn danh mục cho sản phẩm',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $so_luong_errors = $validator->errors()->get('so_luong.*');
            if (!empty($so_luong_errors)) {
                $validator->errors()->add('so_luong', 'Có lỗi trong các trường số lượng.');
                $validator->errors()->forget('so_luong.*');
            }
        });
    }
}
