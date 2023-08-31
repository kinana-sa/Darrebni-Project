<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Controllers\Api\Traits\ImageUploadTrait;
use App\Http\Resources\SliderResource;

class SliderController extends Controller
{
    use ApiResponse, ImageUploadTrait;

    public function index()
    {
        $sliders = Slider::all();

        return $this->successResponse(SliderResource::collection($sliders), "Show All Sliders", 200);
    }

    public function store(SliderRequest $request)
    {

        $image = $this->uploadImage($request, "image", "sliders/");

        $slider = Slider::create([
            'image' => $image,
            'link' => $request->link
        ]);
        return $this->successResponse(new SliderResource($slider), "New Slider Successfully", 201);
    }

    public function show(Slider $slider)
    {
        return $this->successResponse(new SliderResource($slider), "Show Slider Successfully", 200);
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        $image = $this->uploadImage($request, "image", "sliders/");

        $slider->update([
            'image' => $image,
            'link' => $request->link
        ]);
        return $this->successResponse($slider, "Slider Updated Successfully", 200);
    }

    public function destroy(Slider $slider)
    {
        $this->deleteImage($slider->image);
        $slider->delete();
        return $this->successResponse(null, "Slider Deleted Successfully", 200);
    }
}