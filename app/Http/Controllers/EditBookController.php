<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class EditBookController extends Controller
{
    public function getEditPage(int $userId, int $bookId)
    {
        $book = Book::find($bookId);
        return view('create-book')->with('id', $userId)->with('book', $book);
    }

    public function edit(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'bookId' => ['required', 'integer'],
            'authorId' => ['required', 'integer']
        ]);

        $book = Book::find($request->bookId);
        $book->title = $request->title;
        $book->text = $request->text;

        $book->save();

        return redirect("profile/{$request->authorId}/book/{$request->bookId}");
    }
}
