<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class DeleteBookController extends Controller
{
    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        Book::destroy($request->id);
        return redirect()->back();
    }
}
