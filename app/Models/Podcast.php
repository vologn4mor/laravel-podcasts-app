<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'podcast_file', 'podcast_img', 'about', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($podcast) { // before delete() method call this
            $podcast->comments()->delete();
            // do the rest of the cleanup...
        });
    }
}
