<div class="flex flex-col mx-10">

    <x-tags-display :$tags />

    <input type="hidden" name="tags" id="tags" value="{{implode(',', $tags)}}">

    {{-- barre de recherche --}}
    <div class="flex flex-row w-full h-10">
        <div class="relative w-3/12">
            <x-text-input id="tags_search" class="block w-full" type="text" name="tag"
            wire:model.live="query" placeholder="Search tag..." autocomplete="off"/>
            @if (!empty($suggestions))
                <ul class="absolute z-10 w-full mt-2 bg-white border rounded">
                    @foreach ($suggestions as $suggestion)
                    <li class="px-4 py-2 cursor-pointer hover:bg-gray-200" wire:click="addTag('{{$suggestion->name}}')">
                        {{ $suggestion->name }}
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <x-primary-button class="ml-2 bg-green-400 hover:bg-green-300" type="button" id="delayedButton">
            <i class="text-2xl fa-solid fa-plus "></i>
        </x-primary-button>
    </div>

    <script>
        document.getElementById("delayedButton").addEventListener("click", function (){
            var query = document.getElementById("tags_search").value;
            document.getElementById("tags_search").value = "";
            Livewire.dispatch("addTag", {"tagName" : query});
        });

        document.getElementById("tags_search").addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            Livewire.dispatch("addTag", {"tagName" : this.value});
            this.value = '';
        }
        });
    </script>

</div>
