<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class UploadCommentController extends Controller
{
    public function upload(Request $request)
    {
        $comment = new Comment();
        $comment->title = $request->title;
        $comment->message = $request->message;
        $comment->profile_Id = 1;
        $comment->author_Id = 1;
        $comment->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
