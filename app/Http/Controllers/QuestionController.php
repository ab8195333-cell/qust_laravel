<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Report; // تأكد من إضافة هذا السطر في الأعلى

class QuestionController extends Controller
{
    public function create() {
        $questions = Question::with('answers')->latest()->get();
        return view('display.create', compact('questions'));
    }

    public function store(Request $request) {
        Question::create(['title' => $request->title, 'content' => $request->content]);
        return redirect('/questions');
    }

    public function showAnswer($id) {
    // أضفنا 'votes' هنا لكي يتم جلب الأصوات من قاعدة البيانات
    $question = Question::with(['answers', 'votes'])->findOrFail($id);
    return view('display.show', compact('question'));
}

   public function storeAnswer(Request $request, $id) {
    // حفظ الرد وربطه برقم السؤال
    \App\Models\Answer::create([
        'question_id' => $id,
        'content' => $request->content
    ]);
    
    return back(); // العودة لنفس الصفحة لمشاهدة الرد الجديد
}

    // دالة إرسال البلاغ الجديدة
    public function report(Request $request, $id) {
        Report::create([
            'question_id' => $id,
            'reason' => $request->reason
        ]);
        return back()->with('success', 'تم إرسال بلاغك للمشرف بنجاح');
    }

    public function voteUp($id) {
    \App\Models\Vote::create(['question_id' => $id, 'score' => 1]);
    return back();
}

public function voteDown($id) {
    \App\Models\Vote::create(['question_id' => $id, 'score' => -1]);
    return back();
}

public function toggleLike($id) {
    // جلب الـ IP الخاص بالمستخدم
    $userIp = request()->ip();

    $existingLike = \App\Models\Vote::where('question_id', $id)
                                    ->where('user_ip', $userIp)
                                    ->first();

    if ($existingLike) {
        $existingLike->delete(); // إلغاء الإعجاب
    } else {
        // تأكد من إضافة 'user_ip' هنا داخل المصفوفة
        \App\Models\Vote::create([
            'question_id' => $id, 
            'score'       => 1,
            'user_ip'     => $userIp  // هذه هي القطعة التي كانت مفقودة في الاستعلام!
        ]);
    }
    return back();
}

public function toggleLikeAnswer($id) {
    $userIp = request()->ip();
    
    $existingLike = \App\Models\Vote::where('answer_id', $id)
                                    ->where('user_ip', $userIp)
                                    ->first();

    if ($existingLike) {
        $existingLike->delete();
    } else {
        \App\Models\Vote::create([
            'answer_id' => $id, 
            'score'     => 1,
            'user_ip'   => $userIp
        ]);
    }
    return back();
}
}