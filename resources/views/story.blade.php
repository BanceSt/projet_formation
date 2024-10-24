@extends("layouts.main")
@section("title", "Histoire")
@section("aside")

    <div class="h-full pt-3 overflow-y-auto bg-gray-800">
        {{-- Histoire racine  --}}
        <div class="text-xl font-bold text-center text-white">
            {{ $story->root()->first()->title}} <span class="font-normal"> par
               <span class="underline underline-offset-2">
                {{ $story->root()->first()->user ? $story->root()->first()->user->name : "Anonymous"}}
               </span>
            </span>
        </div>

        <div class="flex justify-center">
            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-5 dark:bg-gray-700">
        </div>

        <div class="text-xl font-bold text-center text-white">
            {{ $story->title}} <span class="font-normal"> par
               <span class="underline underline-offset-2">
                {{ $story->user ? $story->user->name : "Anonymous"}}
                </span>
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
            <a href="{{route('story.show', ['id' => $story->father_id ?? 1])}}" class="hover:underline">
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
                 <a href="{{route('story.show', ['id' => $story_sibling->id])}}" class="hover:underline">
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
            <span class="flex mb-2 font-bold capitalize">
                {{$story->question}}
            </span>
            <ul>
            @foreach ($story->children as $story_sons)
                <li >
                    <a href="{{route('story.show', ['id' => $story_sons->id])}}" class="hover:underline">
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

@endsection
@section("content")
{{-- contenu --}}
<div class="flex flex-col items-center w-10/12 h-full min-h-screen pt-5 text-white bg-red-100">
    {{-- titre et author  --}}
    <div class="justify-center text-5xl font-bold align text-zinc-600">
        {{ $story->title}}
    </div>
    <div class="justify-center text-2xl font-bold align text-zinc-800">
        par
        <span class="italic underline underline-offset-2">
            {{ $story->user ? $story->user->name : "Anonymous"}}
        </span>

    </div>

    {{-- illustration --}}
    <div class="mt-5 overflow-hidden bg-black max-h-96">
        <img src="{{asset('storage/' . $story->illustration)}}" alt="" class="object-cover h-full max-h-96">
    </div>

    {{-- content --}}
    <div class="px-10 mt-4 text-xl leading-relaxed text-black">
        {!! \Illuminate\Support\Str::markdown($story->content) !!}
    </div>

    {{-- section choix --}}
    <div class="w-full px-10 mt-5 text-left text-black ">
        <span class="text-2xl font-semibold text-transparent" style="color : #070235;"> {{$story->question}} </span>
        <div class="pl-1">
            @foreach ($story->children as $story_sons)
                    <a class="block relative my-2.5 text-xl reponse_link" href="{{route('story.show', ['id' => $story_sons->id])}}">
                        <i class="no-underline hover:no-underline fa-regular fa-circle-dot"> </i>
                        <span class="w-full h-full reponse"> {{$story_sons->title }} </span>
                    </a>
                <hr style="border-top: dotted 1px;" />
            @endforeach
            <a class="block relative my-2.5 text-xl reponse_link">
                <i class="no-underline hover:no-underline fa-solid fa-circle-plus"> </i>
                <span class="w-full h-full reponse"> Ajouter une autre choix </span>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        reponses_link = document.querySelectorAll(".reponse_link")

        reponses_link.forEach(element => {

            // Ajouter le surlignage
            element.addEventListener("mouseover", function(e) {
                element.querySelector(".reponse").classList.add("underline");
                element.querySelector(".reponse").classList.add("cursor-pointer");
        })

             // Enlever le surlignage
            element.addEventListener("mouseout", function(e) {
                element.querySelector(".reponse").classList.remove("underline");
                element.querySelector(".reponse").classList.remove("cursor-pointer");
        })

    })



        document.getElementById('display_choice').addEventListener('change', function() {
            const contentDiv = document.getElementById('choices');

            if (this.checked) {
                contentDiv.classList.remove('hidden');  // Affiche la div
            } else {
                contentDiv.classList.add('hidden');  // Cache la div
            }
        });
    })

</script>
@endsection
