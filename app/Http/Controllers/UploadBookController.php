<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class UploadBookController extends Controller
{
    public function getUploadPage(int $id)
    {
        return view('create-book')->with('id', $id);
    }

    public function createBook(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'authorId' => ['required', 'integer']
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->text = $request->text;
        $book->authorId = $request->authorId;

        $book->save();

        return redirect("profile/{$request->authorId}/book/all");
    }
}
