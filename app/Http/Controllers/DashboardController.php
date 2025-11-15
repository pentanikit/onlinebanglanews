<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('backend.dashboard');
    }

    public function posts(){
        return view('backend.post');
    }
}
