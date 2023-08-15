<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollageResource;
use App\Models\Collage;

class CollageController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $collages = Collage::all();

        return $this->successResponse(CollageResource::collection($collages),"Show All Collages",200);
    }
}
