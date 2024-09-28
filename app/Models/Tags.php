<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description"
    ];

    public function stories(): BelongsToMany
    {
        return $this->belongsToMany(Story::class);
    }
    public $timestamps = false;
}
