<?php
return [
    'accepted' => 'Bạn phải chấp nhận :attribute.',
    'active_url' => ':attribute không phải là một URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => ':attribute chỉ được chứa chữ cái.',
    'alpha_dash' => ':attribute chỉ được chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num' => ':attribute chỉ được chứa chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => ':attribute phải nằm giữa :min và :max.',
        'file' => ':attribute phải nằm giữa :min và :max kilobytes.',
        'string' => ':attribute phải nằm giữa :min và :max ký tự.',
        'array' => ':attribute phải có từ :min đến :max phần tử.',
    ],
    'boolean' => ':attribute phải là true hoặc false.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'date' => ':attribute không phải là một ngày hợp lệ.',
    'date_format' => ':attribute không khớp với định dạng :format.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải là :digits chữ số.',
    'digits_between' => ':attribute phải nằm giữa :min và :max chữ số.',
    'email' => 'Địa chỉ email không hợp lệ.',
    'exists' => ':attribute đã tồn tại.',
    'filled' => ':attribute là bắt buộc.',
    'image' => ':attribute phải là một hình ảnh.',
    'in' => ':attribute không hợp lệ.',
    'integer' => ':attribute phải là một số nguyên.',
    'ip' => ':attribute phải là một địa chỉ IP hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'confirmed' => 'Mật khẩu xác nhận không khớp.',
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'string' => ':attribute không được lớn hơn :max ký tự.',
        'array' => ':attribute không được có nhiều hơn :max phần tử.',
    ],
    'min' => [
        'numeric' => ':attribute phải ít nhất :min.',
        'file' => ':attribute phải ít nhất :min kilobytes.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
        'array' => ':attribute phải có ít nhất :min phần tử.',
    ],
    'not_in' => ':attribute không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'present' => ':attribute phải được hiện diện.',
    'regex' => ':attribute không đúng định dạng.',
    'required' => ':attribute là bắt buộc.',
    'required_if' => ':attribute là bắt buộc khi :other là :value.',
    'required_unless' => ':attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => ':attribute là bắt buộc khi có :values.',
    'required_with_all' => ':attribute là bắt buộc khi có :values.',
    'required_without' => ':attribute là bắt buộc khi không có :values.',
    'required_without_all' => ':attribute là bắt buộc khi không có bất kỳ :values nào.',
    'same' => ':attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải là :size kilobytes.',
        'string' => ':attribute phải là :size ký tự.',
        'array' => ':attribute phải chứa :size phần tử.',
    ],
    'string' => ':attribute phải là một chuỗi.',
    'timezone' => ':attribute phải là một múi giờ hợp lệ.',
    'unique' => 'Địa chỉ email này đã tồn tại.',
    'url' => ':attribute không hợp lệ.',
    'custom' => [
        'email' => [
            'required' => 'Email là bắt buộc.',
            'email' => 'Email không hợp lệ.',
            'unique' => 'Email này đã tồn tại.',
            'max' => 'Email không được vượt quá 255 ký tự.',
            'regex' => 'Email không đúng định dạng.',
        ],
        'name' => [
            'required' => 'Tên là bắt buộc.',
            'string' => 'Tên phải là một chuỗi.',
            'max' => 'Tên không được vượt quá 255 ký tự.',
            'min' => 'Tên phải có ít nhất 3 ký tự.',
        ],
    ],
];