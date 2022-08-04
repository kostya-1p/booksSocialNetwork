<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ShowUserProfilesController extends Controller
{
    public function show()
    {
        $users = User::all();
        return view('profiles')->with('users', $users);
    }
}
