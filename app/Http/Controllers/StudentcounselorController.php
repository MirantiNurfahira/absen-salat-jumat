<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use DB;

class StudentcounselorController extends Controller
{
    public function index()
    {
    
        return view('studentcounselors.index');
    }
}
