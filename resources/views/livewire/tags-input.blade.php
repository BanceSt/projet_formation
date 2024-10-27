<div class="flex flex-col mx-5">
    {{-- affiche les tags --}}
    {{-- <div class="flex flex-row flex-wrap mb-2">
        @foreach ($tags as $tag)
        <span id="badge-dismiss-default" class="inline-flex items-center px-2 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded me-2 dark:bg-blue-900 dark:text-blue-300 ">
            {{$tag}}
            <button type="button" class="inline-flex items-center p-1 text-sm text-blue-400 duration-500 bg-transparent rounded-sm ms-2 hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300"
                    data-dismiss-target="#badge-dismiss-default" aria-label="Remove" wire:click="deleteTag('{{$tag}}')">
            <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Remove badge</span>
            </button>
        </span>
        @endforeach
    </div> --}}
    <x-tags-display :$tags />

    <input type="hidden" name="tags" id="tags" value="{{implode(',', $tags)}}">

    {{-- barre de recherche --}}
    <div class="flex flex-row w-full h-10 bg-pink-50">
        <div class="relative w-3/12">
            <x-text-input id="tags_search" class="block w-full" type="text" name="tag" wire:model.live="query" placeholder="Search tag..." autocomplete="off"/>
            {{-- <input type="text" name="" id="" class="block w-full" wire:model.live.debounce.500ms="query"> --}}
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
        if (event.key === "Enter") { // Vérifiez si l'input a le focus document.activeElement === this &&
            event.preventDefault();
            Livewire.dispatch("addTag", {"tagName" : this.value});
            this.value = '';
        }
        });
    </script>

</div>
