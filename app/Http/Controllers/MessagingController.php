<?php

namespace App\Http\Controllers;

use App\Events\Messaging;
use App\Models\Organization\Messages;
use Illuminate\Http\Request;

class MessagingController extends Controller
{
    public function broadcast(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $filePath = "storage/avatar/$userId.jpg";
        if (file_exists($filePath)) {
            $avatar = asset($filePath);
        } else {
            $avatar = asset("images/profile.png");
        }

        $messageData = [
            'message' => $request->get('message'),
            'user_id' => $user->id,
            'organization_id' => $request->get('org_id'),
        ];

        Messages::create($messageData);

        $messageData = array_merge($messageData, [
            'user_avatar' => $avatar,
            'user_name' => $user->name . ' ' . $user->lastname,
            'sent_at' => date('h:i A'),
        ]);

        $messaging = new Messaging($request->get('broadcast_on'), json_encode($messageData));
        broadcast($messaging)->toOthers();
        return view('member.message.broadcast', ['data' => $messageData]);
    }

    public function receive(Request $request)
    {
        return view('member.message.receive', ['data' => json_decode($request->get('message'), true)]);
    }
}
