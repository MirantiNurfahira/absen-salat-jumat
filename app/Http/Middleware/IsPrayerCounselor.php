<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsPrayerCounselor
{
	
	public function handle($request, Closure $next)
	{
		if (auth::guard('users')->user()->role !== "prayercounselor") {
			

			return redirect('/login');
		}

		return $next($request);
	}
}

?>