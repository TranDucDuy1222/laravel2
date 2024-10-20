<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckLogin extends FormRequest
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
            'password' => 'required',
            'email' => 'required | ends_with:@fpt.edu.vn,@gmail.com'
        ];
    }
    function messages(){
        return [
            'password.required' => 'Bạn chưa nhập mật khẩu của mình',
            'email.required' => 'Bạn chưa nhập email của mình',
            'email.ends_with' => 'Email không đúng định dạng. Đuôi email có thể là @fpt.edu.vn or @gmail.com',
            ];
    }

}
