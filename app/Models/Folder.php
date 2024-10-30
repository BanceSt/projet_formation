<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Folder extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "user_id",
        "name",
        "description",
        "categorie"
    ];

    // Relations
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function stories() : BelongsToMany {
        return $this->belongsToMany(Story::class, "In_folders", "folder_id", "story_id");
    }
}
