<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

class NotificationController extends Controller
{
    use ApiResponse;
    public function updateToken(Request $request)
    {
        try {
            $request->user()->update(['fcm_token' => $request->token]);
            return $this->successResponse(null, 'Token Updated Successfuly');

        } catch (\Exception $e) {
            return $this->errorResponse('Error' . $e->getMessage());
        }
    }

    public function notification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        try {
            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

            /* or */

            Larafirebase::withTitle($request->title)
                ->withBody($request->content)
                ->sendMessage($fcmTokens);

            Notification::create([
                'title' => $request->title,
                'content' => $request->content
            ]);

            return $this->successResponse(null, 'success', 'Notification Sent Successfully!!');

        } catch (\Exception $e) {

            return $this->errorResponse('Error' . $e->getMessage());
        }
    }
}