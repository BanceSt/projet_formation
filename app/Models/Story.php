<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Story extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        "title",
        "accroche",
        "illustration",
        "content",
        "user_id",
        "question",
        "root_id",
        "father_id",
        "reponse",
        "start",
        "end"
    ];

    // Chaque histoire appartient à un auteur (one-to-many)
    public function user() :BelongsTo {
        return $this->belongsTo(User::class);
    }

    // Chaque histoire peut avoir plusieurs commentaires (one-to-many)
    public function comment() :HasMany {
        return $this->hasMany(Comment::class);
    }

    // Chaque histoire a un ou plusieurs tags (many-to-many)
    public function tags() :BelongsToMany {
        return $this->belongsToMany(Tags::class);
    }

    // Chaque histoire peut êter liker et marquer plusieur fois (many-to-many)
    public function who_like_it() :BelongsToMany {
        return $this->belongsToMany(User::class, "engagemts");
    }



    // Chaque histoire peut être dans plusieurs dossier (many-to-many)
    public function folders() : BelongsToMany {
        return $this->belongsToMany(Folder::class, "In_folders", "story_id", "folder_id");
    }

    // Chaque histoire peut avoir une histoire "père" (one-to-many)
    public function father() : BelongsTo {
        return $this->belongsTo(Story::class, 'father_id');
    }

    // Chaque histoire peut avoir plusieurs histoires "enfants" (one-to-many)
    public function children() : HasMany {
        return $this->hasMany(Story::class, 'father_id');
    }

    // Chaque histoire peut avoir une racine (one-to-many)
    public function root() : BelongsTo {
        return $this->belongsTo(Story::class, 'root_id');
    }

    // Une racine peut avoir plusieurs Histoire (one-to-many)
    public function all_stories() : HasMany {
        return $this->hasMany(Story::class, "root_id");
    }
}
