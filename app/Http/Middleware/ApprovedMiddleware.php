<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovedMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->status === 'approved') {
            return $next($request);
        }
        auth()->logout();
        return redirect()->route('login')->withErrors(['email' => 'Your account is not approved.']);
    }
}
