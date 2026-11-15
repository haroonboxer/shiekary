<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\Authorizable as AuthorizableTrait;

class SSOUser implements Authenticatable, Authorizable
{
    use AuthorizableTrait;

    public $id;
    public $name;
    public $last_name;
    public $email;
    public $user_role;
    public $is_active;
    public $email_verified_at;

    public $roles = [];
    // public $claims = [];

    public $image;
    public $departmentId;
    public $departmentName;
    public $ProvinceId;
    public $ProvinceName;
    public $LName;

    public function __construct(array $attributes = [])
    {
        $this->id = $attributes['id'] ?? null;
        $this->name = $attributes['name'] ?? null;
        $this->last_name = $attributes['last_name'] ?? null;
        $this->email = $attributes['email'] ?? null;
        $this->user_role = $attributes['user_role'] ?? null;
        $this->is_active = $attributes['is_active'] ?? true;
        $this->email_verified_at = $attributes['email_verified_at'] ?? null;

        $this->roles = $attributes['roles'] ?? [];
        // $this->claims = $attributes['claims'] ?? [];

        $this->image = $attributes['image'] ?? null;
        $this->departmentId = $attributes['departmentId'] ?? null;
        $this->departmentName = $attributes['departmentName'] ?? null;
        $this->ProvinceId = $attributes['ProvinceId'] ?? null;
        $this->ProvinceName = $attributes['ProvinceName'] ?? null;
        $this->LName = $attributes['LName'] ?? null;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPasswordName()
    {
        return 'password';
    }

    public function getAuthPassword()
    {
        return null;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // SSOUser does not use Laravel's remember-token mechanism.
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'user_role' => $this->user_role,
            'is_active' => $this->is_active,
            'email_verified_at' => $this->email_verified_at,
            'roles' => $this->roles,
       
            'image' => $this->image,
            'departmentId' => $this->departmentId,
            'departmentName' => $this->departmentName,
            'ProvinceId' => $this->ProvinceId,
            'ProvinceName' => $this->ProvinceName,
            'LName' => $this->LName,
        ];
    }
}
