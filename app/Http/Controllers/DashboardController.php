<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('backend.main');
    }

    public function site_icons(){
        return view('backend.icons');
    }

    public function posts(){
        return view('backend.posts');
    }

    public function categories(){
        return view('backend.categories');
    }

    public function medias(){
        return view('backend.medias');
    }

    public function videos(){
        return view('frontend.videos');
    }

    public function settings(){
        return view('backend.settings');
    }

}
