<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $fillable = ['uuid','specialization_name','collage_id'];

    public function collage(){
        return $this->belongsTo(Collage::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }

}
