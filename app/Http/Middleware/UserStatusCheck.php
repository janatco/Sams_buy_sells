<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class UserStatusCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        /* 
        here we are going to check the user status
        If the user status is block then route to block user page
        If the user registration fee/annual not paid then route to payment page
        */

        //dd(User::annualFeeExpire(auth()->user()->id));


        if (auth()->user()->status == 'ACTIVE') {
            if (auth()->user()->type == 'USER') {

                if (auth()->user()->registration_fee_paid == 1 && (User::annualFeeExpire(auth()->user()->id))) {

                   // dd('HONE');
                    return $next($request);
                } else {
                   // dd('feepay');
                    return redirect('/feePay');
                }
            }
            if (auth()->user()->type == 'ADMIN') {
                // dd(\Request::getRequestUri());

                if (\Request::getRequestUri() === "/home" or \Request::getRequestUri() === "/"  ) {
                    return redirect('/admin'); // return admin home page
                }
                return $next($request);
                
            }
        } else {
            return redirect('/blacklisted');
        }
       // dd(auth()->user()->status);
        //auth()->user()->status;
        return $next($request);
    }
}
