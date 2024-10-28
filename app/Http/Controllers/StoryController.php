<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Story_tag;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    //

    public function show($id)  {
        $story = Story::find($id);

        return view("story", compact("story"));
    }

    public function store(Request $request) {
        // Validation
        $request->validate([
        'title' => 'required|string|max:255',
        'accroche' => 'nullable|string',
        'note' => 'nullable|string',
        'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation du fichier image
        ]);

        // Traitement de l'image si elle est présente
        if ($request->hasFile('illustration')) {
            $file = $request->file('illustration');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/illustration'), $fileName);
        }

        // Stocker les autres données du formulaire
        // Exemple :
        $story = new Story();
        $story->title = $request->title;
        $story->user_id = Auth::check() ? Auth::user()->id : null;
        $story->accroche = $request->accroche;
        $story->note = $request->note;
        $story->illustration = isset($fileName) ? "illustration/" . $fileName : null;
        $story->content = $request->contentEditeur;
        $story->question = $request->question;
        $story->reponse = $request->end ? null : $request->reponse;
        $story->father_id = $request->father_id;
        $story->end = $request->end;
        $story->save();

        // Ajout les tags
        foreach (explode(",", $request->tags)  as $tag) {
            $tag = trim($tag);

            // Vérifier si le tag existe déjà
            $existing_tag = Tags::where("name", $tag)->first();

            if (!$existing_tag)
            {
                $new_tag = new Tags();
                $new_tag->name = $tag;
                $new_tag->save();
                $tag_id = $new_tag->id;
            } else {
                $tag_id = $existing_tag->id;
            }

            $storytag = new Story_tag();
            $storytag->story_id = $story->id;
            $storytag->tags_id = $tag_id;
            $storytag->save();
        }

        // Retourner la réponse JSON avec l'ID de l'histoire
        return response()->json([
        'success' => true,
        'redirectUrl' => route("story.show", ["id" => $story->id])
        ]);
        }

    public function create($id = null) {
        $story = null;
        if ($id) $story = Story::find($id);
        return view("create_story", [
            "story" => $story
        ]);
    }
}
