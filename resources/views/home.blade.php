@extends("layouts.main")
@section("aside")
{{-- sidebar --}}

    <div class="h-full px-1 pb-4 overflow-y-auto ">
        <div class="py-5">
            <h1 class="pb-3.5 text-xl font-bold text-white"> ABOUTS {{ config('app.name') }} </h1>
            <p class="text-gray-300">
                {{ config('app.name') }} est un site de rédaction d'histoire intéractif, qui permet de rédiger des histoires de façon communautaire, il est même possible d'y participer sans compte.
            </p>
        </div>

        <div class="w-full">
            <button type="button" class="w-full px-5 py-2.5 text-md font-medium text-white bg-orange-700 hover:bg-orange-800 focus:ring-4
                focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                onclick="window.location='{{route("register")}}'">
                Rejoignez-nous
            </button>

            <div class="w-full pt-2 pb-2 font-bold text-center text-white text-md">
                    OU
            </div>

            <button type="button" class="w-full px-5 py-2.5 text-md font-medium text-white bg-orange-700 hover:bg-orange-800 focus:ring-4
                focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                onclick="window.location='{{route("story.create")}}'">
                Commencer à écrire !
            </button>
        </div>
    </div>

@endsection

@section("content")
{{-- contenu --}}

    {{-- short presentation --}}
    <div class="w-2/4 ml-20 h-36">
        <div class="text-3xl"> <span class="font-semibold">{{ config('app.name') }}</span> - Histoire Intéractifs</div>
        <div class="text-xl">
            Découvrer et/ou participer à la création de nombreux récits du genre que vous souhaités et avec des possibilités de scénarios infini
        </div>
    </div>

    {{-- Hr personnaliser --}}
    <div class="flex flex-row w-full h-8">
        <div class="flex-grow mx-3 my-3 rounded-lg bg-slate-400"></div>
        <div class="w-8 rounded-full bg-slate-400"></div>
        <div class="flex-grow mx-3 my-3 rounded-lg bg-slate-400"></div>
    </div>

    {{-- section découverte --}}
    @php
        $stories_random = $stories->where('father_id', null)->random(14);
        $stories_recent = $stories->sortByDesc("created_at")->take(14);
    @endphp
    <div class="mb-1 ml-5 text-base font-bold capitalize">
        Découvrez le concept avec ces histoires :
    </div>
    <div class="flex flex-wrap justify-center gap-4 mb-3 ">
        @foreach ($stories_random as $story)
            @livewire("story-box", ["story" => $story, "width_box" => "32%"])
        @endforeach
    </div>

    {{-- Hr personnaliser --}}
    <div class="flex flex-row w-full h-8">
        <div class="flex-grow mx-3 my-3 rounded-lg bg-slate-400"></div>
        <div class="w-8 rounded-full bg-slate-400"></div>
        <div class="flex-grow mx-3 my-3 rounded-lg bg-slate-400"></div>
    </div>

    {{-- section découverte --}}
    <div class="ml-5 text-base font-bold capitalize">
        Les histoires récement actualiser :
    </div>
    <div class="flex flex-wrap justify-center gap-4 mb-3 ">
        @foreach ($stories_recent as $story)
            @livewire("story-box", ["story" => $story, "width_box" => "32%"])
        @endforeach
    </div>

    {{-- Hr personnaliser --}}
    <div class="flex flex-row w-full h-8">
        <div class="flex-grow mx-3 my-3 rounded-lg bg-slate-400"></div>
        <div class="w-8 rounded-full bg-slate-400"></div>
        <div class="flex-grow mx-3 my-3 rounded-lg bg-slate-400"></div>
    </div>

    {{-- section découverte --}}
    <div class="ml-5 text-base font-bold capitalize">
        Les histoires débutées pas nos auteurs les plus populaires :
    </div>
    <div></div>
@endsection
