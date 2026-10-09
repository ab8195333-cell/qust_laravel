<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'content'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // في ملف app/Models/Answer.php
public function votes()
{
    return $this->hasMany(\App\Models\Vote::class, 'answer_id');
}

public function isLikedByUser()
{
    return $this->votes()->where('user_ip', request()->ip())->exists();
}
}