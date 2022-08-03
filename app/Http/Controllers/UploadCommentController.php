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
        $comment->profileId = 1;
        $comment->authorId = 2;
        $comment->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
