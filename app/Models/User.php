<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function scopeByRole($query, string $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }

    public function hasRole(string $role): bool
    {
        return $this->roles->contains('name', $role);
    }

    public function assignRole(string $role): void
    { //if the user does not have the role, assign it
        if (!$this->hasRole($role)) {
            $this->roles()->attach(Role::where('name', $role)->first());
        }
    }

    public function removeRole(string $role): void
    { //if the user has the role, remove it
        if ($this->hasRole($role)) {
            $this->roles()->detach(Role::where('name', $role)->first());
        }
    }

    public function toggleRole(string $role): void
    { //if the user has the role, remove it, otherwise assign it
        if ($this->hasRole($role)) {
            $this->removeRole($role);
        } else {
            $this->assignRole($role);
        }
    }

    public function isAuthor(): bool
    {
        return $this->hasRole('author');
    }

    public function isMember(): bool
    {
        return $this->hasRole('member');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
