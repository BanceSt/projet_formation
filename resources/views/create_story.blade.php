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

@section("content")
<aside id="logo-sidebar" class="z-40 w-2/12 h-screen max-h-full transition-transform -translate-x-full bg-gray-800 border-r border-gray-700 sm:translate-x-0"  aria-label="Sidebar">
    <div class="ml-2 text-gray-100">
        <div class="mt-4 text-xl font-bold text-white">
            Règle :
        </div>
        <div class="mt-2">
            <div>
                <span class="text-base font-semibold"> Limite aux contenus offensants </span>,
                les histoires peuvent aborder des sujets sensibles (propos injurieux, racistes, sexistes, etc.) selon leur contexte.
                Toutefois, il est strictement interdit de promouvoir de tels comportements ou de viser un groupe de manière discriminatoire.
            </div>
            <div>
                <span class="font-semibold"> </span>
            </div>
        </div>
    </div>
</aside>

<div class="flex flex-col w-10/12 h-full max-h-full min-h-screen pt-5 bg-red-100">
    <form action="{{route('story.store')}}" method="POST" enctype="multipart/form-data" class="dropzone" id="upload-form">
    @csrf
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
        <div class="flex items-center justify-center col-start-3 row-start-1 row-end-4 m-4 ">
            <div class="w-64 h-64">
                <!-- this is were the previews should be shown. -->
                <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea">
                    <span> Upload file</span>
                </div>
                <div class="previews"></div>
                {{-- <div class="dz-message" data-dz-message><span>Déposez vos fichiers ici ou cliquez pour télécharger.</span></div> --}}
            </div>

        </div>
    </div>

    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-10 dark:bg-gray-700">

    <div class="flex justify-center ">
        <x-wysiwyg-editor/>
        <input type="hidden" name="contentEditeur" id="contentEditeur">
    </div>


    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-10 dark:bg-gray-700">

    <x-input-label for="question" :value="__('Question :')" class="text-xl"/>
    <x-text-input id="question" class="block w-full mt-1" type="text" name="question" :value="old('question')" value="Quel est votre prochaine action ?"/>


    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-10 dark:bg-gray-700">

    {{-- choix de tag --}}
    @livewire("tags-input")

    <hr class="w-9/12 h-1 mx-auto my-4 bg-gray-400 border-0 rounded md:my-10 dark:bg-gray-700">
    <button type="button" id="valide_but">Submit data and files!</button>
    {{-- <input type="submit" value="Valider" class="border"> --}}
    </form>
</div>


@endsection
