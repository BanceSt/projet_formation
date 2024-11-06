<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentSection extends Component
{
    public $story_id =null;
    public $limit = 4;

    public $comment_text;
    public $replying_to = [];
    public $comment_reply = [];
    public $thread = [];
    public $act_thread = null;


    public function mount($story_id) {
        $this->story_id = $story_id;

    }

    public function display_reply($reply_to) {
        if (in_array($reply_to, $this->replying_to)) {
            unset($this->replying_to[$reply_to]);
            unset($this->comment_reply[$reply_to]);
        } else {
            $this->replying_to[$reply_to] = $reply_to;
            $this->comment_reply[$reply_to] = "";
        }

    }

    public function voir_plus($reply_to) {
        $this->thread[] = $reply_to;
        $this->act_thread = $reply_to;
    }

    public function create_comment($reply_to =null) {
        $comment = new Comment;
        $comment->user_id = Auth::check() ? Auth::user()->id : null;
        $comment->story_id = $this->story_id;
        $comment->content = $reply_to ? $this->comment_reply[$reply_to]  : $this->comment_text;
        $comment->reply_to = $reply_to;
        $comment->save();

        if ($reply_to) {
            unset($this->replying_to[$reply_to]);
            unset($this->comment_reply[$reply_to]);
        }

        // Reset l'input
        $this->reset('comment_text');
    }

    public function recc_comment_branch($id =null, $depth =0, $get_parent = false) {
        $comments = [];

        // Récupérer le parent si necessaire
        if ($get_parent) {
            $comment = Comment::where("id", $id)->first();
            $comments[] = ["comment" => $comment, "depth" => 0];
        }

        // Récupération des commentaires
        $comments_db = Comment::where("story_id", $this->story_id)
                                ->where("reply_to", $id)
                                ->orderBy("created_at", "desc")
                                ->get();

        // Si n'y a aucun commentaire
        if ($comments_db->isEmpty()) return [];

        // on les ajoute à la liste des commentaires
        foreach ( $comments_db as $comment) {
            $comments[] = [ "comment" => $comment,
                            "depth" => $depth];

            // Limite non dépassé
            if (($depth + 1) <= $this->limit) {
                $sub_comments = $this->recc_comment_branch($comment->id, $depth + 1);
                $comments = array_merge($comments, $sub_comments);
            } // Limite dépassé
            else {
                // Vérifiant s'il avait des sous commetaires
                if ($comment->children()->exists()) {
                    // ce tableau permettra de précise qu'il existe d'autre commentaire après même si il ne sont pas visible
                    $comments[count($comments) - 1]["autre"] = true;
                }
            }
        }
        return $comments;
    }

    public function render()
    {
        return view('livewire.comment-section', [
            "comments" => $this->recc_comment_branch($this->act_thread, $this->act_thread ? 1 : 0, $this->act_thread)
        ]);
    }
}
