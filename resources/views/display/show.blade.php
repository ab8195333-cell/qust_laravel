<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $question->title }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f4f7f6; padding: 20px; line-height: 1.6; text-align: right; }
        .container { max-width: 850px; margin: auto; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 20px; border: 1px solid #e2e8f0; }
        
        /* تنسيق عام */
        .question-body { margin-bottom: 20px; }
        .answer-card { padding: 15px; border-bottom: 1px solid #eee; margin-bottom: 10px; }
        .form-control { width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; margin-top: 10px; box-sizing: border-box; }
        .btn-blue { background-color: #3182ce; color: white; padding: 10px 25px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; margin-top: 10px; }
        .report-box { margin-top: 40px; padding: 20px; background-color: #fff5f5; border: 2px solid #feb2b2; border-radius: 10px; }
        .btn-red { background-color: #e53e3e; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%; margin-top: 10px; }
        
        /* تنسيق زر الإعجاب */
        .btn-like { border: none; padding: 5px 15px; border-radius: 20px; cursor: pointer; font-weight: bold; transition: 0.3s; }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ url('/questions') }}" style="display: inline-block; margin-bottom: 20px; color: #4a5568; text-decoration: none;">&larr; العودة للرئيسية</a>

    <div class="card">
        <div class="question-body">
            <h1 style="margin-top: 0; color: #2d3748;">{{ $question->title }}</h1>
            <p style="font-size: 1.2rem; color: #4a5568;">{{ $question->content }}</p>
            <small style="color: #a0aec0;">نُشر في: {{ $question->created_at->format('Y-m-d') }}</small>
        </div>
    </div>

    <div class="card">
        <h3>الردود ({{ $question->answers->count() }})</h3>
        @forelse($question->answers as $answer)
            <div class="answer-card">
                <p>{{ $answer->content }}</p>
                <form action="{{ url('/answer/' . $answer->id . '/toggle-like') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-like" style="
                        background-color: {{ $answer->isLikedByUser() ? '#3182ce' : '#edf2f7' }}; 
                        color: {{ $answer->isLikedByUser() ? 'white' : '#4a5568' }};">
                        👍 أعجبني
                    </button>
                </form>
            </div>
        @empty
            <p>لا توجد إجابات حتى الآن. كن أول من يجيب!</p>
        @endforelse
    </div>

    <div class="card" style="background: #f8fafc;">
        <h3>أضف ردك:</h3>
        <form action="{{ url('/question/' . $question->id . '/answer') }}" method="POST">
            @csrf
            <textarea name="content" class="form-control" rows="4" placeholder="اكتب إجابتك هنا..." required></textarea>
            <button type="submit" class="btn-blue">نشر الرد</button>
        </form>
    </div>

    <div class="report-box">
        <h4 style="color: #c53030; margin-top: 0;">🚩 إبلاغ عن محتوى</h4>
        @if(session('success'))
            <div style="color: #276749; background: #c6f6d5; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ url('/question/' . $question->id . '/report') }}" method="POST">
            @csrf
            <select name="reason" class="form-control" required>
                <option value="">اختر سبباً للبلاغ...</option>
                <option value="محتوى مخالف">محتوى مخالف للشروط</option>
                <option value="سب أو شتم">سب أو شتم</option>
                <option value="سؤال غير واضح">سؤال غير واضح أو مكرر</option>
            </select>
            <button type="submit" class="btn-red">إرسال البلاغ</button>
        </form>
    </div>
</div>

</body>
</html>