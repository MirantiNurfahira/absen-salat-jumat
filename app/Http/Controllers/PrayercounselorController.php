<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use DB;

class PrayercounselorController extends Controller
{
    public function index()
    {
    
        return view('prayercounselors.index');
    }

}