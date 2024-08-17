<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

class Organization extends Controller
{
    public function index()
    {
        return view('guest/organizations/index', ['organizations' => \App\Models\Organization::all()]);
    }
}
