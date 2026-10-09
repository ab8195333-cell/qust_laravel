<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>عالم الأسئلة</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f4f7f6; padding: 20px; }
        .container { max-width: 800px; margin: auto; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .form-control { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #cbd5e0; border-radius: 8px; box-sizing: border-box; }
        .btn-blue { background-color: #3182ce; color: white; padding: 10px 25px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
        
        .question-card { background: white; padding: 15px 20px; margin-bottom: 15px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .btn-like { border: none; padding: 8px 16px; border-radius: 20px; cursor: pointer; font-weight: bold; transition: 0.3s; }
        a { text-decoration: none; color: #2d3748; font-weight: 600; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h3>اطرح سؤالاً جديداً:</h3>
        <form action="{{ url('/question/store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="عنوان السؤال" class="form-control" required>
            <textarea name="content" placeholder="تفاصيل السؤال" class="form-control" rows="3"></textarea>
            <button type="submit" class="btn-blue">نشر السؤال</button>
        </form>
    </div>

    <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">

    <h3>أحدث الأسئلة:</h3>
    @foreach($questions as $question)
        <div class="question-card">
            <a href="{{ url('/question/' . $question->id) }}">{{ $question->title }}</a>
            
            <form action="{{ url('/question/' . $question->id . '/toggle-like') }}" method="POST">
                @csrf
                <button type="submit" class="btn-like" style="
                    background-color: {{ $question->isLikedByUser() ? '#3182ce' : '#edf2f7' }}; 
                    color: {{ $question->isLikedByUser() ? 'white' : '#4a5568' }};">
                    👍 أعجبني
                </button>
            </form>
        </div>
    @endforeach
</div>

</body>
</html>