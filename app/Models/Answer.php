<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory, HasUuid;
    protected $fillable=['uuid','content','isTrue','question_id'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
