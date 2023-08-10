<?php

namespace App\Models;

use App\Models\Code;
use App\Models\Question;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'user_name',
        'phone',
        'role',
        'fcm_token'
    ];

    public function code(){
        return $this->hasOne(Code::class);
    }
    public function questions(){
        return $this->belongsToMany(Question::class)->withPivot('favorites');
    }
    
}
