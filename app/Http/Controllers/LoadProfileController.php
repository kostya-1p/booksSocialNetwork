<?php

namespace App\Http\Controllers;

use App\Models\User;

class LoadProfileController extends Controller
{
    public function showProfile(int $id)
    {
        $user = User::find($id);
        return view('dashboard')->with('user', $user);
    }
}
