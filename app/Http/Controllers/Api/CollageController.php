<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ImageUploadTrait;
use App\Http\Requests\CollageRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollageResource;
use App\Models\Category;
use App\Models\Collage;

class CollageController extends Controller
{
    use ApiResponse, ImageUploadTrait;
    public function index()
    {
        $collages = Collage::all();

        return $this->successResponse(CollageResource::collection($collages), "Show All Collages", 200);
    }
    public function create()
    {
    }
    public function store(CollageRequest $request)
    {

        $file = $request->file('image');
        $image = $this->uploadImage($file);
        $id = Category::where('uuid', $request->category_id)->first()->id;

        $collage = Collage::create([
            'collage_name' => $request->collage_name,
            'category_id' => $id,
            'image' => $image['path'],
        ]);

        return $this->successResponse(new CollageResource($collage), " collage created successfully", 200);
    }
    public function show($uuid)
    {
        try {
            $collage = Collage::where('uuid', $uuid)->first();
            return  $this->successResponse(new CollageResource($collage), "show your product", 200);
        } catch (\Exception $e) {

            return  $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function update(CollageRequest $request, $uuid)
    {
        $collage = Collage::where('uuid', $uuid)->first();
        $file = $request->file('image');
        $image = $this->uploadImage($file);

        if (!$collage) {
            return $this->errorResponse('Collage not found', 404);
        }

        $collage->update([
            'collage_name' => $request->collage_name,
            'image' => $image['path'],
            'category_id' => $request->category_id,

        ]);
        return $this->successResponse(new CollageResource($collage), " collage updated successfully", 200);
    }
    public function destroy($uuid)
    {
        try {
            $collage = Collage::where('uuid', $uuid)->first();
            $image = $collage->image;

            if (!$collage) {
                return $this->errorResponse("Collage not found", 404);
            }
            $this->deleteImage($image);
            $collage->delete();

            return $this->successResponse("Collage deleted successfully", 200);
        } catch (\Exception $e) {
            return $this->errorResponse("An error occurred while deleting the collage", 500);
        }
    }
}
