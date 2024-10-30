<?php

namespace App\Livewire;

use Livewire\Component;

class StoryBox extends Component
{
    public $story;
    public $width_box;

    public function mount($story, $width_box)
    {
        $this->story = $story;
        $this->width_box = $width_box;
    }
    public function render()
    {
        return view('livewire.story-box');
    }
}
