<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsStudentCounselor
{
	
	public function handle($request, Closure $next)
	{
		if (auth::guard('users')->user()->role !== "studentcounselor") {

			return redirect('/login');
		}

		return $next($request);
	}
}

?>