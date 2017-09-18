<?php

namespace App\Http\Middleware\User;

use Closure;

class CanUserUpdate
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
        if (!auth()->user()->can('user-update')) {
            Session()->flash('flash_message_warning', 'Không được quyền sửa người dùng!');
            return redirect()->route('users.index');
        }
        return $next($request);
    }
}
