<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'thumbnail',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // This is a mutator. It sets password attribute when we set attributes to the database.
    //    public function setPasswordAttribute($password) {
    //        $this->attributes['password'] = bcrypt($password);
    //    }
    // bcript is the helper function, that wraps Hash::make method and returns the unique hash.

    protected function password(): Attribute {
        return Attribute::make(
            set: fn ($password) => bcrypt($password),
        );
    }
    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function bookmarks() {
        return $this->hasMany(Bookmark::class)->orderBy('id','desc');
    }

    public function checkBookmark($post_id): bool {
       return $this->hasMany(Bookmark::class)->where('post_id', $post_id)->get()->isEmpty();
    }
}
