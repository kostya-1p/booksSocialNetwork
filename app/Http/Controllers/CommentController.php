<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function showComments(int $id)
    {
        $user = User::find($id);
        $comments = $user->createdComments;

        return view('comments')->with('user', $user)->with('comments', $comments);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'author_id' => ['required', 'integer']
        ]);

        Comment::destroy($request->id);
        return redirect()->back();
    }

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
            $comment->isReply = true;
        }

        $comment->save();

        return redirect(RouteServiceProvider::HOME . '/' . $request->profile_id);
    }
}
