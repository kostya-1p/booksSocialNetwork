<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteCommentController extends Controller
{
    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'author_id' => ['required', 'integer']
        ]);

        Comment::destroy($request->id);
        return redirect()->back();
    }
}
