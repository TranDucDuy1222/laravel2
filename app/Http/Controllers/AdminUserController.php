<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Chỉ hiển thị khách hàng không bị ẩn
        if (!$request->has('role') && !$request->has('is_hidden')) {
            $query->where('role', 0)->where('is_hidden', 0);
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('is_hidden')) {
            $query->where('is_hidden', $request->is_hidden);
        }

        $users = $query->get();

        return view('admin.account', compact('users'));

    }

    public function create()
    {
        return view('admin.add_account');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/',
            ],
            'password' => 'required|min:6',
            'role' => 'required|boolean',
        ]);
    
        // Lưu tài khoản vào database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_hidden' => $request->is_hidden,
        ]);
    
        return redirect()->route('tai-khoan.index')->with('success', 'Tài khoản đã được thêm thành công.');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.account_detail', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->role != 1) {
        return redirect()->route('tai-khoan.index')->with('error', 'Bạn không thể chỉnh sửa tài khoản này.');
        }
        return view('admin.edit_account', compact('user'));
    }

    public function update(Request $request, $id)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|boolean',
        'is_hidden' => 'required|boolean',
        'current_password' => 'nullable|string',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user = User::findOrFail($id);

    // Kiểm tra mật khẩu cũ nếu có nhập
    if ($request->filled('current_password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu cũ không chính xác.'])->withInput();
        }

        // Cập nhật mật khẩu nếu có
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    }

    // Cập nhật thông tin khác
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->role = $request->input('role');
    $user->is_hidden = $request->input('is_hidden');

    $user->save();

    return redirect()->route('tai-khoan.index')->with('success', 'Cập nhật tài khoản thành công!');
}


    public function destroy(string $id)
    {
    }

    public function hide($id)
    {
        $user = User::findOrFail($id);
        $user->is_hidden = 1; // Đặt trạng thái là ẩn
        $user->save();

        return redirect()->route('tai-khoan.index')->with('success', 'Tài khoản đã được ẩn thành công.');
    }

    public function restore($id)
    {
        $user = User::findOrFail($id);
        $user->is_hidden = 0;
        $user->save();

        return redirect()->route('tai-khoan.index')->with('success', 'Tài khoản đã được hiển thị lại thành công.');
    }
}
