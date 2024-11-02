<?php

namespace App\Http\Controllers;

use App\Models\Organization\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
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

        $commentData = [
            'comment' => $request->get('comment'),
            'member_id' => $request->get('member_id'),
            'post_id' => $request->get('post_id'),
        ];

        Comment::create($commentData);

        $commentData = array_merge($commentData, [
            'user_avatar' => $avatar,
            'user_name' => $user->name . ' ' . $user->lastname,
            'sent_at' => date('h:i A'),
        ]);

        $messaging = new \App\Events\Comment($request->get('broadcast_on'), json_encode($commentData));
        broadcast($messaging)->toOthers();
        return view('member.comment.broadcast', ['data' => $commentData]);
    }

    public function receive(Request $request)
    {
        Log::info($request->get('message'));
        return view('member.comment.receive', ['data' => json_decode($request->get('message')['message'], true)]);
    }
}
