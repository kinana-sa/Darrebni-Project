<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;
    // protected $fillable = ['uuid','user_id','question_id'];

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
    // public function questions(){
    //     return $this->hasMany(Question::class);
    // }
}