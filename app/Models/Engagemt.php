<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engagemt extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "user_id",
        "story_id",
        "follow",
        "favorite"
    ];

    // public function story() {
    //     return $this->belongsTo(Story::class);
    // }

    // public function
}
