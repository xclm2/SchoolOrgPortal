<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function index($id)
    {
        return view('post/index');
    }
}
