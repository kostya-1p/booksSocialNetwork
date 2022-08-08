<?php

namespace App\Http\Controllers;

use App\Models\User;
use function Symfony\Component\String\s;

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

    public function loadRestComments(int $id)
    {
        $user = User::find($id);
        $comments = $user->commentsAtProfile()->get();

        $skip = 0;
        $comments = $comments->skip($skip);

        $authorNames = $this->getAuthorNames($comments);

        $responseCommentArray = $this->getResponseArray($comments, $authorNames, $skip);
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

    private function getResponseArray($comments, $authorNames, $authorNamesOffset): array
    {
        $responseArray = [];
        foreach ($comments as $index => $comment)
        {
            $responseArray[] = $this->getItemOfResponseArray($comment, $authorNames[$index - $authorNamesOffset]);
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
            "answeredCommentId"=>$comment->answeredCommentId,
            "isReply"=>$comment->isReply];
    }
}
