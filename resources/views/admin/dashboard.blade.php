<div style="direction: rtl; padding: 20px;">
    <h1>لوحة تحكم المشرف - البلاغات المعلقة</h1>
    
    @foreach($reports as $r)
        <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; background: #fff;">
            @if($r->question_id)
                <p style="background: #ffeeba;"><strong>بلاغ عن سؤال:</strong> {{ $r->question->title }}</p>
            @elseif($r->answer_id)
                <p style="background: #ffeeba;"><strong>بلاغ عن إجابة:</strong> {{ $r->answer->content }}</p>
            @endif
            
            <p>تاريخ البلاغ: {{ $r->created_at->format('Y-m-d') }}</p>
            
            <div style="display: flex; gap: 10px;">
                <form action="/admin/report/{{ $r->id }}/resolve" method="POST">
                    @csrf
                    <button type="submit" style="background: green; color: white;">تجاهل (سليم)</button>
                </form>
                
                <form action="/admin/report/{{ $r->id }}/delete" method="POST">
                    @csrf
                    <button type="submit" style="background: red; color: white;">حذف المحتوى (مخالف)</button>
                </form>
            </div>
        </div>
    @endforeach
</div>