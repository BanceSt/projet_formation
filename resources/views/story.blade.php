@extends("layouts.main")
@section("title", "Histoire")
@section("content")
<aside id="logo-sidebar" class="z-40 w-2/12 h-screen px-2 transition-transform -translate-x-full bg-gray-800 border-r border-gray-700 sm:translate-x-0"  aria-label="Sidebar">
    <div class="h-full pt-3 overflow-y-auto bg-gray-800">
        {{-- Histoire racine  --}}
        <div class="text-xl font-bold text-center text-white">
            {{ $story->root()->first()->title}} <span class="font-normal"> par
               <span class="underline underline-offset-2"> {{ $story->root()->first()->user->name}} </span>
            </span>
        </div>

        <div class="flex justify-center">
            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-5 dark:bg-gray-700">
        </div>

        <div class="text-xl font-bold text-center text-white">
            {{ $story->title}} <span class="font-normal"> par
               <span class="underline underline-offset-2"> {{ $story->user->name}} </span>
            </span>
        </div>

        {{-- note de l'auteur --}}
        @isset($story->note)
        <div class="pt-5 text-base text-gray-400">
            <span class="flex font-bold"> note auteur : </span> {{
                $story->note
            }}
        </div>
        @endisset

        {{-- histoire père --}}
        @isset($story->father_id)
        <div class="pt-5 text-base text-slate-400">
            <span class="flex font-bold capitalize"> histoire père : </span>
            <a href="{{route('story', ['id' => $story->father_id ?? 1])}}" class="hover:underline">
            {{
                $story->father()->first()->title
            }}
            </a>
        </div>


        {{-- histoire frère --}}

        <div class="pt-5 text-base text-slate-400">
            <span class="flex font-bold capitalize">
                choix précédents :
            </span>
        <ul>
        @foreach ($story->father->children as $story_sibling)
            <li >
                 <a href="{{route('story', ['id' => $story_sibling->id])}}" class="hover:underline">
                    {{ $story_sibling->title }}
                </a>
            </li>
        @endforeach
        </ul>
        </div>
        @endisset

        @if($story->children->first())


        {{-- histoire fils --}}
        <div class="flex items-center pt-5 pl-1 mb-4">
            <input id="display_choice" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="display_choice" class="text-sm font-medium text-gray-300 ms-2">Afficher les choix actuels</label>
        </div>

        <div id="choices" class="hidden pt-1 text-base text-slate-400">
            <span class="flex font-bold capitalize">
                choix précédents :
            </span>
        <ul>
        @foreach ($story->children as $story_sons)
            <li >
                 <a href="{{route('story', ['id' => $story_sons->id])}}" class="hover:underline">
                    {{ $story_sons->title }}
                </a>
            </li>
        @endforeach
        </ul>
        </div>

        @endif

        {{-- tag de la branche  --}}
        <div class="pt-5 text-base text-slate-400">
            <span class="flex font-bold capitalize">
                Tags :
            </span>
            {{ implode(", " ,$story->tags->pluck("name")->toArray())}}
        </div>







    </div>
</aside>

<script>
    document.getElementById('display_choice').addEventListener('change', function() {
        const contentDiv = document.getElementById('choices');

        if (this.checked) {
            contentDiv.classList.remove('hidden');  // Affiche la div
        } else {
            contentDiv.classList.add('hidden');  // Cache la div
        }
    });

</script>
@endsection
