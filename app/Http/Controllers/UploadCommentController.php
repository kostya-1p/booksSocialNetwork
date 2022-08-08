<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadCommentController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
            'profile_id' => ['required', 'integer']
        ]);

        $comment = new Comment();
        $comment->title = $request->title;
        $comment->message = $request->message;
        $comment->profileId = $request->profile_id;
        $comment->authorId = Auth::id();

        if (isset($request->answered_comment_id))
        {
            $comment->answeredCommentId = $request->answered_comment_id;
        }

        $comment->save();

        return redirect(RouteServiceProvider::HOME . '/' . $request->profile_id);
    }
}
