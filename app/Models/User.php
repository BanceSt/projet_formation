<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'private_email',
        'networks',
        'birthday',
        'profile_picture',
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
            'networks' => 'array',
            'password' => 'hashed',
        ];
    }

    public function story(): HasMany {
        return $this->hasMany(Story::class);
    }

    public function comment(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function folder(): HasMany {
        return $this->hasMany( Folder::class);
    }

    public function follow(): BelongsToMany {
        return $this->belongsToMany(User::class, "follows", "follower_id", "follow_id");
    }

    public function follower(): BelongsToMany {
        return $this->belongsToMany(User::class, "follows", "follow_id", "follower_id");
    }

    public function what_i_like() :BelongsToMany {
        return $this->belongsToMany(Story::class, "engagemts");
    }
}
