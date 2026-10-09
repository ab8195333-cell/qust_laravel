<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // عرض صفحة البلاغات للمشرف
    public function index()
    {
        $reports = Report::with('question')->latest()->get();
        return view('admin.reports', compact('reports'));
    }

    // الدالة التي كانت مفقودة وتسببت في الخطأ
    public function deleteQuestion($id)
    {
        $report = Report::findOrFail($id);

        // حذف السؤال المرتبط بالبلاغ أولاً
        if ($report->question) {
            $report->question->delete();
        }

        // حذف البلاغ نفسه
        $report->delete();

        return back()->with('success', 'تم حذف السؤال والبلاغ بنجاح');
    }
}