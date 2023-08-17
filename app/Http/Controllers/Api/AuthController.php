<?php

namespace App\Http\Controllers\Api;

use App\Models\Code;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Models\Collage;

class AuthController extends Controller
{
    use ApiResponse;
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {

            $user = User::create([
                'user_name' => $request->user_name,
                'phone' => $request->phone

            ]);
            $collage = Collage::where('uuid', $request->collage_uuid)->first();
            $code = Code::where('collage_id', $collage->id)->whereNull('user_id')->first();

            $code->update([
                'user_id' => $user->id
            ]);
            DB::commit();
            return $this->successResponse($user, 'User Registered Successfully.', 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse('Error. ' . $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        $user = User::where('user_name', $request->user_name)
            ->whereHas('code', function ($query) use ($request) {
                $query->where('value', $request->passcode);
            })
            ->first();

        if (!$user) {
            return $this->errorResponse('Invalid User Name or Passcode', 401);
        }

        $token = $user->createToken('Api-Token')->plainTextToken;
        $data['token']=$token;
        $data['user_name']=$user->user_name;
        $collage=$user->code()->first()->collage_id;


        $data['collage']=Collage::find($collage)->first();
       return $this->successResponse($data, "Logged in successfuly", 200);
       // return $this->successResponse($token, "Logged in successfuly", 200);

    }

    public function logout()
    {
        User::findOrFail(Auth::id())->currentAccessToken()->delete();
        //Auth::guard('web')->logout();
        return $this->successResponse(null, "User Logedout Successfully.", 200);
    }
}
