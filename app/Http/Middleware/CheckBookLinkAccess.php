<?php

namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBookLinkAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bookId = $request->route('book_id');
        $book = Book::find($bookId);

        $id = Auth::id();
        $accessedLibraries = User::find($id)->accessedLibraries()->where('library_id', $request->route('user_id'))->get();

        $isLinkAvailable = $book->isAvailable;
        $hasAccessToLibrary = !$accessedLibraries->isEmpty() || $id == $request->route('user_id');

        if (!$isLinkAvailable && !$hasAccessToLibrary)
        {
            return redirect()->back();
        }

        return $next($request);
    }
}
