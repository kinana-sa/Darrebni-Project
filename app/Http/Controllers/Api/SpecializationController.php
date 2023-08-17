<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecializationResource;
use App\Models\Collage;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    use ApiResponse;
    //get collage's specialization
    public function getCollageSpec($uuid)
    {
        $collage = Collage::where('uuid', $uuid)->first();
        $specializations = $collage->specializations()->get();
        return $this->successResponse(SpecializationResource::collection($specializations), "Show All Specialization", 200);
    }
}
