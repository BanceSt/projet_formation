<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

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
        $story->accroche = $request->accroche;
        $story->note = $request->note;
        $story->illustration = isset($fileName) ? $fileName : null;
        $story->content = $request->contentEditeur;
        $story->question = $request->question;

        $story->save();
         // Retourner la réponse JSON avec l'ID de l'histoire
        return response()->json([
        'success' => true,
        'redirectUrl' => route("story.show", ["id" => $story->id])
        ]);
        }

    public function create() {
        return view("create_story");
    }
}
