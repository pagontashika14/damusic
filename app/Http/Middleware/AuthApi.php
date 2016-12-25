<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helper\FillError;
use App\User;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->cookie('api_token');
        if($token) {
            $request->offsetSet('api_token', $token);
        }
        $user = User::where('api_token',$request->api_token)->with('roles')->first();
        if($user) {
            $request->offsetSet('auth_user_id', $user->id);
            $role = $user->roles[0]->order;
            $request->offsetSet('auth_user_role', $role);
            $timeExpire = Carbon::parse($user->remember_token);
            $now = Carbon::now();
            $dif = $now->diffInMinutes($timeExpire,false);
            if($dif > 0) {
                return $next($request);
            }
        }
        if($request->no_redirect){
            return response(null);
        } else {
            return redirect()->route('login',['current_link' => $request->path()]);
        }
    }
}
