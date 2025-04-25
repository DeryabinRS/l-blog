<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\UserStatus;
use App\UserRole;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'email',
        'password',
        'role',
        'status',
        'picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatus::class,
            'role' => UserRole::class,
        ];
    }

    public function getPictureAttribute($value)
    {
        return $value ? asset('/images/users/' . $value) : asset('/images/users/avatar.png');
    }

    public function social_links()
    {
        return $this->belongsTo(UserSocialLink::class, 'id', 'user_id');
    }

    public function getRoleAttribute($value)
    {
        return $value;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function isAdmin()
    {
        return ($this->role === 'superAdmin' || $this->role === 'admin') ? true : false;
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('email', 'like', $term)
                ->orWhere('firstname', 'like', "%" . $term . "%")
                ->orWhere('lastname', 'like', "%" . $term . "%");
        });
    }
}
