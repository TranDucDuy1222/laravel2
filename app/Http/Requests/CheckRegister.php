<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRegister extends FormRequest
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
            'name' => ['required', 'string', 'regex:/^[\p{L}\p{N}\s]+$/u', 'min:3', 'max:30'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'confirmed', 'min:8'],            
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên của bạn.',
            'name.string' => 'Tên phải là chuỗi ký tự hợp lệ.',
            'name.regex' => 'Tên chỉ được chứa chữ cái, số và khoảng trắng, không được chứa ký tự đặc biệt.',
            'name.min' => 'Tên phải có ít nhất :min ký tự. Tên hiện tại quá ngắn.',
            'name.max' => 'Tên không được vượt quá :max ký tự. Tên hiện tại quá dài.',
            
            'email.required' => 'Vui lòng nhập địa chỉ email của bạn.',
            'email.email' => 'Địa chỉ email phải hợp lệ. Ví dụ: example@domain.com.',
            'email.max' => 'Email không được dài quá :max ký tự.',
            'email.unique' => 'Email này đã được sử dụng. Vui lòng chọn một email khác.',
            
            'password.required' => 'Vui lòng nhập mật khẩu của bạn.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp. Vui lòng kiểm tra lại.',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự. Vui lòng chọn mật khẩu dài hơn.',
        ];
    }

}
