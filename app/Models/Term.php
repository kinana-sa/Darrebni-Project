<?php

namespace App\Models;

use App\Models\Collage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;
    protected $fillable=['uuid','term_name','collage_id'];
    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }
}
