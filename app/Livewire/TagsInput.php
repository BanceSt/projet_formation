<?php

namespace App\Livewire;

use App\Models\Tags;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TagsInput extends Component
{
    public $tags = [];
    protected $listeners = ['addTag'];

    public $query = '';

    public function addTag($tagName) {
        // Vérifier si le tag n'est pas déjà ajouté
        if ($tagName and (!in_array($tagName, $this->tags))) {
            $this->tags[] = $tagName;
        }

        $this->query = '';
    }

    public function deleteTag($tagName) {
        $key = array_search($tagName, $this->tags);
        unset($this->tags[$key]);
    }

    public function updatedQuery(): array|Collection {
        if (strlen($this->query) >= 1) {
            return Tags::where("name", "LIKE", "%" . $this->query . "%")
                    ->whereNotIn('name', $this->tags)
                    ->take(5)
                    ->get();
        } else {
            return [];
        }
    }

    public function render()
    {
        return view('livewire.tags-input', [
            "suggestions" => $this->updatedQuery()
        ]);
    }
}
