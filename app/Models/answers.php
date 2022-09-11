<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answers extends Model
{
    use HasFactory;
    protected $fillable=[
        'questions_id',
        'answer',
        'correct'
    ];

    public function question()
    {
        return $this->belongsTo(questions::class,'questions_id','id');
    }
}
