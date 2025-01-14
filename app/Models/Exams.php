<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'img'
    ];

    public function question()
    {
        return $this->hasMany(questions::class);
    }
}
