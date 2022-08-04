<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ShowUserCommentsController extends Controller
{
    public function showComments(int $id)
    {
        $user = User::find($id);
        $comments = $user->createdComments;

        return view('comments')->with('user', $user)->with('comments', $comments);
    }
}
