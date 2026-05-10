<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnsureSingleSessionGuard
{
    private const DEVICE_COOKIE = 'nextlink_device_id';

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasSession()) {
            if (! $this->sessionBelongsToCurrentDevice($request)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->withErrors(['email' => 'Session sécurisée réinitialisée. Veuillez vous reconnecter.']);
            }

            Auth::shouldUse('web');

            if (Auth::check()) {
                $request->session()->put('auth_guard', 'web');
                $request->session()->put('auth_user_id', Auth::id());

                if (! $request->session()->has('auth_device_id')) {
                    self::rememberCurrentDevice($request);
                }
            }
        }

        return $next($request);
    }

    private function sessionBelongsToCurrentDevice(Request $request): bool
    {
        $sessionDeviceId = $request->session()->get('auth_device_id');

        if (! $sessionDeviceId) {
            return true;
        }

        $cookieDeviceId = $request->cookie(self::DEVICE_COOKIE);

        return is_string($cookieDeviceId) && hash_equals($sessionDeviceId, $cookieDeviceId);
    }

    public static function rememberCurrentDevice(Request $request): void
    {
        $deviceId = $request->cookie(self::DEVICE_COOKIE) ?: Str::random(64);

        $request->session()->put('auth_device_id', $deviceId);

        Cookie::queue(cookie(
            self::DEVICE_COOKIE,
            $deviceId,
            60 * 24 * 365,
            '/',
            null,
            false,
            true,
            false,
            'lax'
        ));
    }

}
