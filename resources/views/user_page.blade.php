@extends("layouts.main")
@php
    use Carbon\Carbon;
    Carbon::setLocale('fr');
    $formattedDate = Carbon::createFromFormat('Y-m-d', $user->birthday)->format('d F Y');
@endphp

@section("title")
    @if ((auth()->check()) and ($user->name === auth()->user()->name))
        Ma page
    @else
        Page de {{$user->name}}
    @endif
@endsection

@section("aside")
@endsection

@section("class_div_content", "items-center")
@section("content")
{{-- contenu --}}
    <div class="flex items-center justify-center w-full h-56 mb-32">
        <div class="flex rounded shadow-md bg-gray-200/75 h-52">
            <div class="size-52">
                <img class="object-cover w-full h-full rounded"
                src="{{asset($user->profile_picture ?? 'storage/pp/placeholder_pp.png' )}}">
            </div>

            <div class="flex flex-col flex-grow h-full px-2">
                <div class="text-2xl text-left text-slate-800">
                    {{$user->name}}
                </div>
                <hr class="w-full h-0.5 mx-auto my-0.5 bg-gray-700 border-0 rounded md:my-0.5">
                <div class="grid grid-cols-2 text-black gap-x-6 gap-y-1">
                    <div class="no-wrap"> Anniversaire : {{$formattedDate}}</div>
                    <div class="no-wrap"> histoires lues : 0</div>
                    <div> histoires commencées : {{$user->story()->where("father_id", null)->count()}} </div>
                    <div> histoires contribués : {{$user->story()->count()}}</div>
                    <div> Authors suivis : 0</div>
                    <div> Abonnés : 0 </div>
                </div>

            </div>
        </div>
    </div>

    <div class="flex-grow w-full ">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="creation-tab"
                    data-tabs-target="#creation" type="button" role="tab" aria-controls="creation" aria-selected="false"> Création </button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
                </li>
                <li role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="creation" role="tabpanel" aria-labelledby="creation-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
        </div>
    </div>

@endsection



