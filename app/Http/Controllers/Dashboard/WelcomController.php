<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class WelcomController extends Controller
{
    public function index(){
        return view('dashboard.welcom');
    }
}
