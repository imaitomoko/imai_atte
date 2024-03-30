<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function user()
    {
        $users = Auth::user()
        ->paginate(5);

        return view('user',compact('users'));
    }

}
