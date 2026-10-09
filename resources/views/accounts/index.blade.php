<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة الحسابات</title>
    <style>
        body { font-family: Tahoma, sans-serif; background: #f4f7f6; padding: 20px; text-align: right; }
        .container { max-width: 900px; margin: auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: right; }
        th { background-color: #3182ce; color: white; }
        .btn { padding: 6px 14px; border-radius: 6px; text-decoration: none; font-weight: bold; cursor: pointer; border: none; font-size: 14px; }
        .btn-blue { background: #3182ce; color: white; display: inline-block; margin-bottom: 15px; }
        .btn-yellow { background: #d69e2e; color: white; }
        .btn-red { background: #e53e3e; color: white; }
    </style>
</head>
<body>
<div class="container">
    <h2>جدول عرض الحسابات</h2>
    <a href="{{ url('/accounts/create') }}" class="btn btn-blue">+ إضافة حساب جديد (لوحة التحكم)</a>

    @if(session('success'))
        <div style="background: #c6f6d5; color: #276749; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->email }}</td>
                    <td>
                        <!-- زر التعديل -->
                        <a href="{{ url('/accounts/' . $account->id . '/edit') }}" class="btn btn-yellow">تعديل</a>
                        
                        <!-- زر الحذف -->
                        <form action="{{ url('/accounts/' . $account->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-red">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

