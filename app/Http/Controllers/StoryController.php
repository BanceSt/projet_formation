<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    //

    public function index($id)  {
        $story = Story::find($id);

        return view("story", compact("story"));
    }
}
