<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user1=User::where('uuid',$id)->first();
if($user1){
  $data['user_name']=$user1->user_name;
  $data['phone']=$user1->phone;
 return $this->successResponse($data,'This user data');
    }else{
        return $this->errorResponse();
    }}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
$new_user=User::where('uuid',$id)->first();
if($new_user){
$new_user->update([
'user_name'=>$request->user_name,
'phone'=>$request->phone,
]);
return $this->successResponse('Updated');
    }else{
        return $this->errorResponse('The user not found');
    }}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
