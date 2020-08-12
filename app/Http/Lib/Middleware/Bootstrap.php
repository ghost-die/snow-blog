<?php


namespace App\Http\Lib\Middleware;

use App\Http\Lib\Facades\Admin;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Bootstrap
{
	public function handle(Request $request, Closure $next)
	{
		Admin::bootstrap();
		return $next($request);
	}
}