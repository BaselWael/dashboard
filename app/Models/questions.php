<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    use HasFactory;
    protected $fillable=[
        'exam_id',
        'question',
        'type'
    ];

    public function exam()
    {
        return $this->belongsTo(Exams::class);
    }
    public function answer()
    {
        return $this->hasMany(answers::class);
    }
}
