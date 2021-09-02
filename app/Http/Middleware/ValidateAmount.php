<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ValidateAmount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $messages = [
            'required' => 'The :attribute field is required',
            'min' => 'The :attribute must be greater than 10 Naira'
        ];
        $request->validate([
            'amount'=> 'required|integer|min:10'
        ], $messages);
        return $next($request);
    }
}
