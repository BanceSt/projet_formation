@extends("layouts.main")
@section("title", "Création d'histoire")

@section("cdn")
<script src="https://kit.fontawesome.com/89eaa3121d.js" crossorigin="anonymous"></script>
@endsection

@section("vite")
@vite(['resources/js/create_story.js', 'resources/js/rich_editor.js'])
@endsection

@section("meta")
<meta name="store-url" content="{{ route('story.store') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section("aside")

    <div class="ml-2 text-gray-100">
        <div class="mt-4 text-xl font-bold text-white">
            Règle :
        </div>
        <div class="mt-2">
            <div class="flex flex-col">
                <span class="text-base font-semibold"> Limite aux contenus offensants. </span>
                <hr style="border-top: dotted 1px;" />
                <span class="text-base font-semibold"> Pas de plagiats. </span>
                <hr style="border-top: dotted 1px;" />
                <span class="text-base font-semibold"> Pas de harcèlement ou de cyberintimidation. </span>
                <hr style="border-top: dotted 1px;" />
                <span class="text-base font-semibold"> Étiquetage obligatoire. </span>
                {{-- les histoires peuvent aborder des sujets sensibles (propos injurieux, racistes, sexistes, etc.) selon leur contexte.
                Toutefois, il est strictement interdit de promouvoir de tels comportements ou de viser un groupe de manière discriminatoire. --}}
            </div>
            <div>
                <span class="font-semibold"> </span>
            </div>
        </div>
    </div>

@endsection

@section("content")
    {{-- Ajoute d'un une branche --}}

    <form action="{{route('story.store')}}" method="POST" enctype="multipart/form-data" class="dropzone" id="upload-form">
    @csrf
    @if ($story)
    <div class="flex flex-col items-center">
        <div class="text-2xl text-gray-700/85">
            Ajout d'une branche à
            <span class="font-semibold text-black">  {{$story->title}} </span>
        </div>

        <div class="flex flex-col w-full px-10 mt-2 text-xl ">
            <div> {{$story->question}} </div>
            <x-input-label for="reponse" :value="__('Reponse :')" class="text-xl"/>
            <x-text-input id="reponse" class="block w-full mt-1" type="text" name="reponse" :value="old('reponse')"/>
            <div class="text-black/45"> # Si aucune réponse n'est entrée alors le titre sera choisis comme réponse </div>
        </div>

        <input type="hidden" name="father_id" id="father_id" value="{{$story->id}}" />


    </div>
    @else
    <div class="text-3xl font-semibold text-center text-gray-700/85">
        Début d'une nouvelle histoire
    </div>
    @endif

    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-10 dark:bg-gray-700">


    <div class="grid grid-cols-3 mx-5">
        <div class="col-span-2">
            <x-input-label for="title" :value="__('Titre :')" class="text-xl"/>
            <x-text-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="col-span-2 mt-2">
            <x-input-label for="accroche" :value="__('Accroche :')" class="text-xl"/>
            <x-text-area id="accroche" class="block w-full mt-1" type="text" name="accroche" :value="old('accroche')" required autofocus />
            <x-input-error :messages="$errors->get('accroche')" class="mt-2" />
        </div>

        <div class="col-span-2 mt-2">
            <x-input-label for="note" :value="__('Note :')" class="text-xl"/>
            <x-text-area id="note" class="block w-full mt-1" type="text" name="note" :value="old('note')" required autofocus />
            <x-input-error :messages="$errors->get('note')" class="mt-2" />
        </div>

        {{-- illustration --}}
        <div class="flex items-center justify-center col-start-3 row-start-1 row-end-4 ">
            <div class="relative flex items-center justify-center size-52">
                <div id="dropzoneDragArea" class="z-10 flex flex-col items-center justify-center size-48 dz-default dz-message dropzoneDragArea">
                    <span class="z-0 w-full p-0 pointer-events-none togone"> Upload file </span>
                    <span class="z-0 w-full p-0 pointer-events-none togone"> Click or Drop file here </span>
                </div>

            </div>

        </div>
    </div>

    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-5 dark:bg-gray-700">

    {{-- Refaction de l'histoire --}}


    <div class="flex flex-col items-center text-gray-700/95">
        <span class="w-10/12 mb-2 text-2xl font-semibold"> Partie rédaction de l'histoire : </span>
        <x-wysiwyg-editor/>
        <input type="hidden" name="contentEditeur" id="contentEditeur">
    </div>



    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-10 dark:bg-gray-700">

     {{-- question et fin de branche --}}
    <div class="px-10">
        @isset($story)
        <div class="flex flex-row items-center">
            <label for="end" class="pr-2"> Fin de Branche ? </label>
            <input type="checkbox" name="end" id="end" value="">
            <div class="pl-2 text-black/45"> # Si cette case est coché cette branche sera considérée comme fini, et personne ne pourra contribué à celle-ci. Ainsi aucune question ne sera nécéssaire</div>
        </div>
        @endisset
        <x-input-label for="question" :value="__('Question :')" class="text-xl" />
        <x-text-input id="question" class="block w-full mt-1" type="text" name="question" :value="old('question')" value="Quel est votre prochaine action ?"/>
    </div>

    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-10 dark:bg-gray-700">

    {{-- choix de tag --}}
    @livewire("tags-input", ["story" => $story])

    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-10 dark:bg-gray-700">
    <div class="w-full px-10">
        <button type="button" id="valide_but" class="px-4 py-2 bg-green-400 rounded hover:bg-green-300">
            Submit data and files!
        </button>
    </div>

    {{-- <input type="submit" value="Valider" class="border"> --}}
    </form>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        endElement = document.querySelector("#end");

        if (endElement) {
            endElement.addEventListener("change", (e) => {
            if (endElement.checked) {
                document.querySelector("#question").disabled = true;
                document.querySelector("#question").classList.add("bg-gray-400/40")
            } else {
                document.querySelector("#question").disabled = false;
                document.querySelector("#question").classList.remove("bg-gray-400/40")
            }
        })
        }

    })
</script>
@endsection
