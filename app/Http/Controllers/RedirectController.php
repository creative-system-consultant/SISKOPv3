<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        if (Auth::user()){
            return redirect('home');
        } else {
            return redirect('login');
        }
    }
}
