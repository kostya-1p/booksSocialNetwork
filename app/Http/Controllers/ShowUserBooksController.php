<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ShowUserBooksController extends Controller
{
    public function showBooks(int $id)
    {
        $user = User::find($id);
        $books = $user->books()->get();

        return view('books')->with('books', $books)->with('user', $user);
    }
}
