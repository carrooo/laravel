<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\users;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $semua = Users::count();
        $siswa = Users::where('type','1')->count();
        $guru = Users::where('type','2')->count();
        return view('home',[
            'semua' => $semua,
            'siswa' => $siswa,
            'guru' => $guru,
        ]);
    }
}
