<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class In_folder extends Model
{
    use HasFactory;

    protected $primaryKey = ['folder_id', 'story_id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "folder_id",
        "story_id"
    ];
}
