<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // عرض جميع الحسابات
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }

    // صفحة إنشاء حساب
    public function create()
    {
        return view('accounts.create');
    }

    // حفظ الحساب الجديد
    public function store(Request $request)
    {
        Account::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/accounts')
            ->with('success', 'تم إنشاء الحساب بنجاح');
    }

    // صفحة تعديل الحساب
    public function edit($id)
    {
        $account = Account::findOrFail($id);

        return view('accounts.edit', compact('account'));
    }

    // تحديث بيانات الحساب
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $account->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $account->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect('/accounts')
            ->with('success', 'تم تعديل الحساب بنجاح');
    }

    // حذف الحساب
    public function destroy($id)
    {
        Account::destroy($id);

        return redirect('/accounts')
            ->with('success', 'تم حذف الحساب بنجاح');
    }
}
