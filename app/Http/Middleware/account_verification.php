<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class account_verification
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

            $user = Auth::user();
            if ($user->email_verified_at != NULL) {
                return $next($request);
            } else {
                return redirect()->route('home', compact('user'))->with('note', 'verify your email to access those resources');
            }

    }
}
