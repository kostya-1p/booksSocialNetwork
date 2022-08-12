<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showAllUsers()
    {
        $users = User::all();
        return view('profiles')->with('users', $users);
    }

    public function showProfile(int $id = 1)
    {
        $user = User::find($id);
        $comments = $user->commentsAtProfile()->skip(0)->take(5)->get();
        $authorNames = $this->getAuthorNames($comments);

        $userToAccess = Auth::id();
        $isAvailable = false;

        if (isset($userToAccess))
        {
            $accessedLibraries = $user->libraryAccesses()->where('user_id_with_access', $userToAccess)->get();
            $isAvailable = !$accessedLibraries->isEmpty();
        }

        return view('dashboard')->with('user', $user)->with('comments', $comments)->
        with('authorNames', $authorNames)->with('isLibraryAvailable', $isAvailable);
    }

    public function loadRestComments(int $id)
    {
        $user = User::find($id);
        $comments = $user->commentsAtProfile()->get();
        $authorNames = $this->getAuthorNames($comments);

        $responseCommentArray = $this->getResponseArray($comments, $authorNames);
        return json_encode($responseCommentArray);
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

    private function getResponseArray($comments, $authorNames): array
    {
        $responseArray = [];
        foreach ($comments as $index => $comment)
        {
            $responseArray[] = $this->getItemOfResponseArray($comment, $authorNames[$index]);
        }

        return $responseArray;
    }

    private function getItemOfResponseArray($comment, $authorName): array
    {
        return ["id" => $comment->id,
            "profileId" => $comment->profileId,
            "authorId" => $comment->authorId,
            "authorName" => $authorName,
            "title" => $comment->title,
            "message" => $comment->message,
            "created_at" => $comment->created_at,
            "answeredCommentId" => $comment->answeredCommentId,
            "isReply" => $comment->isReply];
    }
}
