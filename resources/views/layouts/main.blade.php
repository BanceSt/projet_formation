<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://kit.fontawesome.com/89eaa3121d.js" crossorigin="anonymous"></script>
    @yield("cdn")
    @yield("vite")
    @yield("meta")
    <title>@yield('title', "Home")</title>
</head>
<body>

    <div class="h-full max-h-full min-h-screen">
        {{-- Navbar --}}
        <nav class="border-gray-200 bg-orange-900/85 ">
            <div class="flex flex-wrap items-center justify-between max-w-full p-2">
                <a href="{{route('home')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold text-white whitespace-nowrap">Posty</span>
                </a>


                <form class="w-3/6 max-w-4xl mx-auto ">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
                        <button type="submit" style="bottom : 0.0625rem;"
                                class="text-white absolute end-0.5 bg-orange-500 hover:bg-orange-600
                                focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-4 py-2
                                 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                            Search
                        </button>
                    </div>
                </form>



                <div class="relative flex {{auth()->check() ? 'items-center' : 'items-baseline'}} flex-row space-x-3 text-white rtl:space-x-reverse">

                    <button type="button" class="inline-flex text-white bg-gradient-to-r from-orange-400 via-orange-500 to-orange-500
                                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-orange-300 dark:focus:ring-orange-800
                                                font-medium rounded-lg text-xl px-2.5 py-1 text-center"
                            onclick="window.location='{{route("story.create")}}'">
                        NEW
                        <i class="self-center text-sm fa-solid fa-pen ps-2"></i>
                    </button>

                    @auth
                    <div id="profil_picture" class="relative rounded size-8 bg-slate-400">
                        <a href="{{route("profil.show", auth()->user()->name)}}" class="size-8">
                            <img src="{{asset(auth()->user()->profile_picture ? auth()->user()->profile_picture : 'storage/pp/placeholder_pp.png' )}}"
                            alt="image de profile" class="object-cover w-full h-full rounded">
                        </a>

                        <div id="menu_pp" class="absolute right-0 hidden w-48 h-auto text-gray-200 bg-orange-900/85 border-2 border-orange-900/95 rounded top-10 menu_pp">
                            <div class="ml-2 font-semibold text-left">
                                <a href="{{route("profil.show", auth()->user()->name)}}">
                                {{auth()->user()->name}}
                                </a>
                            </div>
                            <hr class="w-11/12 h-0.5 mx-auto my-0.5 bg-gray-400 border-0 rounded md:my-0.5 dark:bg-gray-700 ">
                            <hr class="w-11/12 h-0.5 mx-auto my-0.5 bg-gray-400 border-0 rounded md:my-0.5 dark:bg-gray-700 ">
                            <div class="ml-2 text-left">
                                Dernière lecture
                            </div>
                            <div class="ml-2 text-left">
                                Paramètre
                            </div>
                            <hr class="w-11/12 h-0.5 mx-auto my-0.5 bg-gray-400 border-0 rounded md:my-0.5 dark:bg-gray-700 ">
                            <div class="ml-2 text-left">
                                <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button onclick="window.location='{{route("logout")}}'">
                                    Se déconnecter
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @else
                    <div class="mr-2 text-xl">
                    <a href="{{route('register')}}" class="font-semibold whitespace-nowrap"> Sign In </a>
                    <span class="text-2xl font-semibold whitespace-nowrap"> /  </span>
                    <a href="{{route('login')}}" class="font-semibold whitespace-nowrap"> Sign Up </a>
                    </div>
                    @endauth
                </div>


            </div>
        </nav>

        <div class="flex flex-row w-full h-full min-h-screen">
            <aside id="logo-sidebar" class="sticky top-0 z-40 w-2/12 h-screen px-2 transition-transform -translate-x-full border-r border-orange-700 bg-orange-800/55 sm:translate-x-0"  aria-label="Sidebar">
            @yield("aside")
            </aside>
            <div class="@yield("class_div_content") flex flex-col w-10/12 h-auto min-h-screen pt-5 bg-gradient-to-b from-orange-50/45 to-orange-100/15">
            @yield("content")
            </div>
        </div>


    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var hovering_menu_pp = false;
            var timeout_menu_pp = null;

            var menu_pp = document.getElementById("menu_pp");
            var profile_picture = document.getElementById("profil_picture");

            if (menu_pp) {
                menu_pp.addEventListener("mouseover", (e) => {
                hovering_menu_pp = true;
            })

            menu_pp.addEventListener("mouseout", (e) => {
                hovering_menu_pp = false;
            })
            }

            if (profile_picture) {
                profile_picture.addEventListener("mouseover", (e) => {
                menu_pp.classList.remove("hidden")
                menu_pp.style.maxHeight = menu_pp.scrollHeight + "px";
                clearTimeout(timeout_menu_pp);
            })

            profile_picture.addEventListener("mouseout", (e) => {
                timeout_menu_pp = setTimeout(() => {
                    if (!hovering_menu_pp) {
                        menu_pp.style.maxHeight = "0px";
                        setTimeout(() => {
                            menu_pp.classList.add("hidden");
                        }, 450)
                    }
                }, 500);

            })
            }



        })
    </script>
    @livewireScripts
</body>
</html>
