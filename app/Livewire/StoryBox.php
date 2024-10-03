<?php

namespace App\Livewire;

use Livewire\Component;

class StoryBox extends Component
{
    public $story;

    public function mount($story)
    {
        $this->story = $story;
    }
    public function render()
    {
        return view('livewire.story-box');
    }
}
