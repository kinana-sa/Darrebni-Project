<?php

namespace App\Models;

use App\Models\Term;
use App\Models\User;
use App\Models\Answer;
use App\Models\Collage;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['uuid','content','reference','term_id','specialization_id','collage_id'];
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('favorites');
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
