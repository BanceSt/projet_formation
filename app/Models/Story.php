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
        "start",
        "end"
    ];

    public function user() :BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function tags() :BelongsToMany {
        return $this->belongsToMany(Tags::class);
    }

    // Relation auto-référentielle : Une story peut avoir un "père"
    public function father() : BelongsTo {
        return $this->belongsTo(Story::class, 'father_id');
    }

    // Relation inverse : Une story peut avoir plusieurs "enfants"
    public function children() : HasMany {
        return $this->hasMany(Story::class, 'father_id');
    }

    // Relation auto-référentielle : Une story peut avoir une racine
    public function root() : BelongsTo {
        return $this->belongsTo(Story::class, 'root_id');
    }

    // Relation inverse : Une racine peut avoir plusieurs stories
    public function all_stories() : HasMany {
        return $this->hasMany(Story::class, "root_id");
    }
}
