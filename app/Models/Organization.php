<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Organization extends Model
{
    use HasFactory;

    public function created_by_details()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
