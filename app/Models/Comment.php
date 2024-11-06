<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "reply_to",
        "story_id",
        "content"
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function story(): BelongsTo {
        return $this->belongsTo(Story::class);
    }

    // Relation auto-référentielle : Une story peut avoir un "père"
    public function father() : BelongsTo {
        return $this->belongsTo(Comment::class, 'reply_to');
    }

    // Relation inverse : Une story peut avoir plusieurs "enfants"
    public function children() : HasMany {
        return $this->hasMany(Comment::class, 'reply_to');
    }
}
