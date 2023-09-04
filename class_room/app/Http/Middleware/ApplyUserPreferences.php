<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApplyUserPreferences
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = ['en', 'ar'];
        $header = $request->header('accept-language');
        $locales = explode(',', $header);
        if ($locales) {
            foreach ($locales as $locale) {
                if (($i = strpos($locale, ';')) !== false) {
                    $locale = substr($locale, strpos($locale, 0, $i));
                }
                if (in_array($locale, $supported)) {

                    break;
                }
            }
        }
        $user = Auth::user();
        if ($user) {
            App::setLocale($user->profile->locale ?? $locale);
        }
        return $next($request);
    }
}
