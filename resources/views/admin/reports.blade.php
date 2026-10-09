<div style="direction: rtl; padding: 20px;">
    <h2>لوحة تحكم المشرف - البلاغات الواردة</h2>
    <table border="1" width="100%">
        <tr>
            <th>السؤال المُبلغ عنه</th>
            <th>سبب البلاغ</th>
            <th>التاريخ</th>
            <th>إجراء</th>
        </tr>
        @foreach($reports as $report)
        <tr>
            <td>{{ $report->question->title }}</td>
            <td>{{ $report->reason }}</td>
            <td>{{ $report->created_at->diffForHumans() }}</td>
            <td>
                <form action="/admin/reports/{{ $report->id }}/delete" method="POST">
                    @csrf
                    <button type="submit" style="color: red;">حذف السؤال نهائياً</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>