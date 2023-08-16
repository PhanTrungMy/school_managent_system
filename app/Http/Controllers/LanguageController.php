<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class LanguageController extends Controller
{
    public function ChangeLanguage(Request $request, $language)
    {
        Session::put('lang', $language);

        return back();
    }
    
}
