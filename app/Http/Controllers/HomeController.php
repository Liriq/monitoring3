<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGettext;
use Laratrust;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redirectTo = '/';
        if (Laratrust::hasRole('admin')) {
            $redirectTo = '/admin';
        } elseif (Laratrust::hasRole('employee')) {
            $redirectTo = '/dashboard';
        }
        
        return redirect($redirectTo);
    }
    
    /**
     * Changes the current language and returns to previous page
     * @return Redirect
     */
    public function changeLang($locale=null)
    {
        LaravelGettext::setLocale($locale);
        
        return redirect()->back();
    }    
}
