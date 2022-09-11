<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toolsContent extends Model
{
    use HasFactory;
    protected $fillable=[
        'tools_id',
        'value'
    ];

    public function question()
    {
        return $this->belongsTo(tools::class,'tool_id','id');
    }
}
