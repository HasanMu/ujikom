<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use Auth;

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
        /* Bisa Kayak Gini
         *  if(Auth::user()->hasRole('admin')) {
         *     return 'Hai';
         *  }
        */
        # Atau Gini
        # Asal tambahkan => use Laratrust\LaratrustFacade as Laratrust;
        if(Laratrust::hasRole('admin')) {
            return view('home');
        }
    }
}
