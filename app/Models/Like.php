<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function likedBy(User $user)
    {
        return $this->contains('user_id', $user->id);
    }
}
