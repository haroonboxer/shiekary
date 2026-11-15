<?php

namespace App\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Contracts\Auth\Guard;

use Throwable;


class JwtGuard implements Guard
{
    protected $user = null;

    public function user()
    {
        if ($this->user !== null) {
            return $this->user;
        }

        // Read JWT from the HTTP-only cookie.
        $token = request()->session()->get('sso_access_token')
            ?? request()->cookie('access_token')
            ?? request()->bearerToken();

        if (!$token) {
            return null;
        }

        try {

            $secret = config('services.sso.jwt_secret');

            if (!$secret) {
                logger()->error('SSO JWT secret is not configured.');
                return null;
            }

            // Validate and decode JWT.
            $decoded = JWT::decode(
                $token,
                new Key($secret, 'HS256')
            );

            // Convert JWT object to array.
            $data = json_decode(
                json_encode($decoded),
                true
            );

            // Read UserInfo.
            $userInfo = $data['UserInfo'] ?? [];

            if (is_string($userInfo)) {
                $userInfo = json_decode($userInfo, true) ?? [];
            }

            if (is_object($userInfo)) {
                $userInfo = json_decode(
                    json_encode($userInfo),
                    true
                );
            }

            if (!is_array($userInfo)) {
                $userInfo = [];
            }

            // Read roles.
            $roles = $data['Role'] ?? [];

            if (is_string($roles)) {
                $decodedRoles = json_decode($roles, true);

                $roles = json_last_error() === JSON_ERROR_NONE
                    ? $decodedRoles
                    : [$roles];
            }

            if (is_object($roles)) {
                $roles = (array) $roles;
            }

            if (!is_array($roles)) {
                $roles = [];
            }

            // Read user ID from JWT claims or UserInfo.
            $userId =
                $data['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/nameidentifier']
                ?? $userInfo['Id']
                ?? null;

            if (!$userId) {
                logger()->error('SSO JWT does not contain User ID.');
                return null;
            }

            // Create SSO user.
            $this->user = new SSOUser([

                'id' => $userId,

                'name' =>
                $userInfo['Name']
                    ?? $data['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name']
                    ?? '',

                'email' =>
                $userInfo['Email']
                    ?? $data['email']
                    ?? '',

                'image' => $userInfo['Image'] ?? '',

                'roles' => $roles,

                'departmentId' =>
                $userInfo['DepartmentId'] ?? null,

                'departmentName' =>
                $userInfo['DepartmentName'] ?? '',

                'ProvinceId' =>
                $userInfo['ProvinceId'] ?? null,

                'ProvinceName' =>
                $userInfo['ProvinceName'] ?? '',

                'LName' =>
                $userInfo['UserNameInLocalLang'] ?? '',
            ]);

            return $this->user;
        } catch (Throwable $e) {

            logger()->error('SSO JWT validation failed', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    public function check()
    {
        return $this->user() !== null;
    }

    public function guest()
    {
        return !$this->check();
    }

    public function id()
    {
        return $this->user()?->id;
    }

    public function validate(array $credentials = [])
    {
        return false;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function hasUser()
    {
        return $this->user !== null;
    }
}
