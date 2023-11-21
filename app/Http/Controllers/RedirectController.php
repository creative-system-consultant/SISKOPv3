<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        if (Auth::guest()){
            return redirect('login');
        } else if(Auth::User()->client_id == NULL) {
            return redirect(route('dash.guest'));
        } else {
            return redirect('home');
        }
    }
}
