<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Controllers\Api\Traits\ImageUploadTrait;

class UserController extends Controller
{
    use ApiResponse, ImageUploadTrait;

    public function index()
    {
        $users = User::all();

        return $this->successResponse($users, "Show All Users", 200);
    }

    public function show(User $user)
    {
        if (auth()->user() || auth()->user()->isAdmin()) {
            return $this->successResponse(new UserResource($user), 'Show User Successfully.');
        } else {
            return $this->unauthorized();
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string',
            'phone' => 'required|string|digits_between:7,20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }
        $user = User::find(auth()->user()->id);
        if ($user) {
            $image = $this->uploadImage($request, 'image', 'profiles/');
            $user->update([
                'user_name' => $request->user_name,
                'phone' => $request->phone,
                'image' => $image ?? $user->image
            ]);
            return $this->successResponse(new UserResource($user), 'User Updated Successfully.');
        } else {
            return $this->unauthorized();
        }
    }
    public function destroy(User $user)
    {
        if (auth()->user()->id == $user->id || auth()->user()->isAdmin()) {
            if ($user->image) {
                $this->deleteImage($user->image);
            }
            $user->delete();
            return $this->successResponse(null, "User Deleted Successfully", 200);
        } else {
            return $this->unauthorized();
        }
    }
    public function deletedUsers()
    {
        $deleted_users = User::onlyTrashed()->get();
        
        return $this->successResponse($deleted_users, "Show Deleted Users Successfully", 200);
    }
    
    public function restoreUser($id)
    {
        $user = User::withTrashed()->where('id', $id)->restore();
        
        return $this->successResponse($user, "User Restored Successfully", 200);
    }
}