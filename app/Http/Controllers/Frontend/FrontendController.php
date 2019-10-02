<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use LaravelGettext;
use Laratrust;

class FrontendController extends Controller
{    
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
