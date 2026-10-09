<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل الحساب</title>
    <style>
        body { font-family: Tahoma, sans-serif; background: #f4f7f6; padding: 20px; text-align: right; }
        .container { max-width: 500px; margin: auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .form-control { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #cbd5e0; border-radius: 6px; box-sizing: border-box; }
        .btn-yellow { background: #d69e2e; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%; }
    </style>
</head>
<body>
<div class="container">
    <h2>لوحة التحكم - تعديل الحساب</h2>
    <a href="{{ url('/accounts') }}" style="color: #4a5568; text-decoration: none; display: inline-block; margin-bottom: 15px;">&larr; العودة للجدول</a>
    
    <form action="{{ url('/accounts/' . $account->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>الاسم:</label>
        <input type="text" name="name" value="{{ $account->name }}" class="form-control" required>

        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" value="{{ $account->email }}" class="form-control" required>

        <label>كلمة المرور الجديدة (اختياري):</label>
        <input type="password" name="password" class="form-control" placeholder="اتركها فارغة إن لم ترد تغييرها">

        <button type="submit" class="btn-yellow">تحديث الحساب</button>
    </form>
</div>
</body>
</html>
