<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse, ImageUploadTrait;
    public function index()
    {
        $categories = Category::all();
        return $this->successResponse(CategoryResource::collection($categories), "show all categories", 200);
    }

    public function store(CategoryRequest $request)
    {
        $file = $request->file('image');
        $image = $this->UploadImage($file);
        $category = Category::create([
            'name' => $request->name,
            'image' => $image['path']
        ]);
        return $this->successResponse(new CategoryResource($category), "category ceated successfully", 200);
    }
    public function show($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();
        return $this->successResponse(new CategoryResource($category), " This is your category", 200);
    }
    public function update(CategoryRequest $request, $uuid)
    {
        $category = Category::where('uuid', $uuid)->first()->id;
        $file = $request->file('image');
        $image = $this->uploadImage($file);
        $category->update([
            'name' => $request->name,
            'image' => $image['path'],
        ]);
        return $this->successResponse(new CategoryResource($category), " category updated successfulle", 200);
    }
    public function destroy($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();
        $image = $category->image;
        $this->deleteImage($image);
        $category->delete();
        return $this->successResponse(" category deleted successfulle", 200);
    }
}
