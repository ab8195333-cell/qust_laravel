<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة حساب جديد</title>
    <style>
        body { font-family: Tahoma, sans-serif; background: #f4f7f6; padding: 20px; text-align: right; }
        .container { max-width: 500px; margin: auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .form-control { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; }
        .btn-blue { background: #3182ce; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%; }
    </style>
</head>
<body>
<div class="container">
    <h2>لوحة التحكم - إنشاء حساب</h2>
    <a href="{{ url('/accounts') }}" style="color: #4a5568; text-decoration: none; display: inline-block; margin-bottom: 15px;">&larr; العودة للجدول</a>
    
    <form action="{{ url('/accounts') }}" method="POST">
        @csrf
        <label>الاسم:</label>
        <input type="text" name="name" class="form-control" required>

        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" class="form-control" required>

        <label>كلمة المرور:</label>
        <input type="password" name="password" class="form-control" required>

        <button type="submit" class="btn-blue">حفظ الحساب</button>
    </form>
</div>
</body>
</html>