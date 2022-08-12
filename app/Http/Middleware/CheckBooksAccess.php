<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBooksAccess
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
        $id = Auth::id();
        $accessedLibraries = User::find($id)->accessedLibraries()->where('library_id', $request->route('id'))->get();

        if ($accessedLibraries->isEmpty() && $id != $request->route('id'))
        {
            return redirect()->back();
        }

        return $next($request);
    }
}
