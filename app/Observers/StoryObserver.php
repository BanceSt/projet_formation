<?php

namespace App\Observers;

use App\Models\Story;

class StoryObserver
{
    //
    public function creating(Story $story) {
        // Si la story n'a pas encore de root_id, elle devient sa propre racine
        if (is_null($story->root_id) and is_null($story->father_id)) {
            $story->root_id = $story->id;
        } else if (is_null($story->root_id) and $story->father_id) {
            $story->root_id = Story::where("id", $story->father_id)->first()->root_id;
        }
    }

    public function created(Story $story)
    {
        // Si la story vient d'être créée et que root_id est vide, elle devient sa propre racine
        if (is_null($story->root_id) and is_null($story->father_id)) {
            $story->root_id = $story->id;
        } else if (is_null($story->root_id) and $story->father_id) {
            $story->root_id = Story::where("id", $story->father_id)->first()->root_id;
        }
    }
}
