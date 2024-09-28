<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    //
    public function show() {
        $stories = Story::all();
        return view('home', [
            "stories" =>  $stories
        ]);
    }
}
