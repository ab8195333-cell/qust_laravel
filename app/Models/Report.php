<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // هذا السطر هو الذي يحل المشكلة (إعطاء إذن التعبئة)
    protected $fillable = ['question_id', 'reason'];

    // علاقة البلاغ بالسؤال المرتبط به
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}