<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // السماح بإدخال البيانات في هذه الأعمدة
    protected $fillable = ['title', 'content'];

    // علاقة السؤال بالأجوبة
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function isLikedByUser()
{
    // يتحقق هل المستخدم الحالي (عبر الـ IP) قد وضع "لايك" لهذا السؤال
    return \App\Models\Vote::where('question_id', $this->id)
                           ->where('user_ip', request()->ip())
                           ->exists();
}

    public function votes() {
    return $this->hasMany(Vote::class);
}
}