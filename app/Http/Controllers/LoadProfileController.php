<?php

namespace App\Http\Controllers;

use App\Models\User;

class LoadProfileController extends Controller
{
    public function showProfile(int $id = 1)
    {
        $user = User::find($id);
        $comments = $user->commentsAtProfile()->skip(0)->take(5)->get();
        $authorNames = $this->getAuthorNames($comments);

        return view('dashboard')->with('user', $user)->with('comments', $comments)->
               with('authorNames', $authorNames);
    }

    private function getAuthorNames($comments): array
    {
        $authors = [];
        foreach ($comments as $comment)
        {
            $authors[] = $comment->commentAuthor->name;
        }

        return $authors;
    }
}
