<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->user()->role != 'Admin'){
            return redirect(route('post.index'))->with('error','You don\'t have permission to access this features.');
        }
        // dd($request->user()->email);
        return $next($request);
    }
}
