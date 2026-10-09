<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController; 

// ================================
// مسارات الأسئلة والردود
// ================================

Route::get('/questions', [QuestionController::class, 'create']);
Route::post('/question/store', [QuestionController::class, 'store']);
Route::get('/question/{id}', [QuestionController::class, 'showAnswer']);
Route::post('/question/{id}/answer', [QuestionController::class, 'storeAnswer']);

// إرسال بلاغ
Route::post('/question/{id}/report', [QuestionController::class, 'report']);

// ================================
// مسارات المشرف
// ================================

Route::get('/admin/reports', [AdminController::class, 'index']);
Route::post('/admin/reports/{id}/delete', [AdminController::class, 'deleteQuestion']);

// ================================
// مسارات التصويت والإعجاب
// ================================

Route::post('/question/{id}/vote/up', [QuestionController::class, 'voteUp']);
Route::post('/question/{id}/vote/down', [QuestionController::class, 'voteDown']);

Route::post('/question/{id}/toggle-like', [QuestionController::class, 'toggleLike']);

Route::post('/answer/{id}/toggle-like', [QuestionController::class, 'toggleLikeAnswer']);

// ================================
// مسارات إدارة الحسابات (CRUD)
// ================================

// عرض جميع الحسابات
Route::get('/accounts', [AccountController::class, 'index']);

// صفحة إنشاء حساب
Route::get('/accounts/create', [AccountController::class, 'create']);

// حفظ الحساب الجديد
Route::post('/accounts', [AccountController::class, 'store']);

// صفحة تعديل الحساب
Route::get('/accounts/{id}/edit', [AccountController::class, 'edit']);

// تحديث الحساب
Route::put('/accounts/{id}', [AccountController::class, 'update']);

// حذف الحساب
Route::delete('/accounts/{id}', [AccountController::class, 'destroy']);


Route::get('/', function () {
    return redirect('/questions');
});