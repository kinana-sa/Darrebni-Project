<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecializationRequest;
use App\Http\Resources\SpecializationResource;
use App\Models\Collage;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    use ApiResponse;
    //get collage's specialization

    public function index()
    {
       $specializations=Specialization::all();
        return $this->successResponse(SpecializationResource::collection($specializations),"show All specializaton ",200);
    }
    public function store(SpecializationRequest $request)
    {
        $collage_id=Collage::where('uuid',$request->collage_id)->first()->id;
         $spec=Specialization::create([
        'specialization_name'=>$request->specialization_name,
        'collage_id'=>$collage_id
         ]);
         return $this->successResponse(new SpecializationResource($spec),"specialization created successfully",200);
    }
    public function update(SpecializationRequest $request,$uuid)
    {$specialization=Specialization::where('uuid',$uuid)->first();
        $collage_id=Collage::where('uuid',$request->collage_id)->first()->id;

          $specialization->update([
            'specialization_name'=>$request->specialization_name,
            'collage_id'=>$collage_id,
          ]);
          return $this->successResponse(new SpecializationResource($specialization),"specialization updated successfully",200);
    }

    public function destroy($uuid)
    {
        $specialization=Specialization::where('uuid',$uuid)->first();
        $specialization->delete();
        return $this->successResponse("specialization updated successfully",200);

    }
    public function getCollageSpec($uuid)
    {
        $collage = Collage::where('uuid', $uuid)->first();
        $specializations = $collage->specializations()->get();
        return $this->successResponse(SpecializationResource::collection($specializations), "Show All Specialization", 200);
    }
}
