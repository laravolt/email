<?php
namespace Laravolt\Email\Middleware;

use Closure;
use Krucas\Notification\Facades\Notification;

class CheckEmail
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
        if(auth()->guest() || $this->shouldPassThrough($request)) {
            return $next($request);
        }

        if(auth()->user()->email === null) {
            Notification::warning(trans('email::email.must_fill_email'));
            return redirect(config('email.redirect'));
        }

        return $next($request);
    }

    protected function shouldPassThrough($request)
    {
        $except = array_merge((array) config('email.except'), (array) config('email.redirect'));

        foreach ($except as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        return false;
    }

}
