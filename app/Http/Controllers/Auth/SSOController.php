<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
 


class SSOController extends Controller
{


    public function login(Request $request)
    {
        $token = $request->input('token');

        if (!$token) {
            return response('SSO token missing.', 401);
        }

        try {

            $secret = config('services.sso.jwt_secret');

            if (!$secret) {
                return response('SSO secret not configured.', 500);
            }

            // Validate JWT.
            JWT::decode(
                $token,
                new Key($secret, 'HS256')
            );
            $exp = isset($decoded->exp)
                ? (int) $decoded->exp
                : null;


            $request->session()->put('sso_access_token', $token);

            // Regenerate session ID.
            $request->session()->regenerate();

            // Redirect to home.
            return redirect()->route('home');
        } catch (\Throwable $ex) {

            logger()->error('SSO Login Error', [
                'message' => $ex->getMessage(),
            ]);

            return response('SSO authentication failed.', 401);
        }
    }



    public function redirectToSSO(Request $request)
    {
        $ssoLoginUrl = env('SSO_URL');

        $returnUrl = urlencode($request->fullUrl());

        return redirect($ssoLoginUrl . '?redirectUrl=' . $returnUrl);
        // return "hello world";
    }
    public function redirectToSSOToHomePage()
    {
        $ssoLoginUrl = env('SSO_URL_To_Home');
        return redirect($ssoLoginUrl);
    }

    public function logout(Request $request)
    {
        // Remove SSO JWT from Laravel session.
        $request->session()->forget('sso_access_token');

        // Destroy Laravel session.
        $request->session()->invalidate();

        // Regenerate CSRF token.
        $request->session()->regenerateToken();

        // Redirect to central ASP.NET Core SSO.
        $ssoLoginUrl = env('SSO_URL');

        return redirect()->away($ssoLoginUrl);
    }
}
