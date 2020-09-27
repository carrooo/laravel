<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DassController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
