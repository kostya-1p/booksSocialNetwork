<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function showBooks(int $id)
    {
        $user = User::find($id);
        $books = $user->books()->get();

        return view('books')->with('books', $books)->with('user', $user);
    }

    public function showBookById(int $userId, int $bookId)
    {
        $book = Book::find($bookId);

        return view('book')->with('book', $book);
    }

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

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        Book::destroy($request->id);
        return redirect()->back();
    }

    public function grantAccess(Request $request)
    {
        $this->validateRequestForChangingAccess($request);
        $idGrantAccessTo = $request->profile_id;
        $this->libraryAccessedUsers()->attach($idGrantAccessTo);
        return redirect()->back();
    }

    public function disableAccess(Request $request)
    {
        $this->validateRequestForChangingAccess($request);
        $idDisableAccessOf = $request->profile_id;
        $this->libraryAccessedUsers()->detach($idDisableAccessOf);
        return redirect()->back();
    }

    private function validateRequestForChangingAccess(Request $request)
    {
        $request->validate([
            'profile_id' => ['required', 'integer']
        ]);
    }

    private function libraryAccessedUsers()
    {
        $libraryId = Auth::id();
        $user = User::find($libraryId);
        return $user->libraryAccesses();
    }

    public function toggleBookLinkSharing(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        $book = Book::find($request->id);
        $book->isAvailable = !$book->isAvailable;
        $book->save();

        return redirect()->back();
    }
}
