<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/89eaa3121d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="h-screen min-h-screen">
        {{-- Navbar --}}
        <nav class="bg-gray-900 border-gray-200 ">
            <div class="flex flex-wrap items-center justify-between max-w-full p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold text-white whitespace-nowrap">Flowbite</span>
                </a>


                <form class="w-3/6 max-w-4xl mx-auto ">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
                        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>



                <div class="flex items-center space-x-3 text-white rtl:space-x-reverse">
                    <a href="" class="text-2xl font-semibold whitespace-nowrap"> Sign In </a>
                    <span class="text-2xl font-semibold whitespace-nowrap"> /  </span>
                    <a href="" class="text-2xl font-semibold whitespace-nowrap"> Sign Up </a>
                    <button type="button" class="inline-flex text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-2xl px-2.5 py-1 text-center me-2">
                        NEW
                        <i class="self-center text-base fa-solid fa-pen ps-2"></i>
                    </button>
                </div>


            </div>
        </nav>

        <div class="flex flex-row w-full h-full min-h-screen">
        {{-- sidebar --}}
        <aside id="logo-sidebar" class="z-40 w-64 h-screen transition-transform -translate-x-full bg-gray-800 border-r border-gray-700 sm:translate-x-0"  aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
                <div class="py-5">
                    <h1 class="pb-3.5 text-xl font-bold text-white"> ABOUTS {{ config('app.name') }} </h1>
                    <p class="text-gray-300">
                        {{ config('app.name') }} est un site de rédaction d'histoire intéractif, qui permet de rédiger des histoires de façon communautaire, il est même possible d'y participer sans compte.
                    </p>
                </div>

                <div class="w-full">
                    <button type="button" class="w-full px-5 py-2.5 text-md font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                        focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Rejoignez-nous
                    </button>

                    <div class="w-full pt-2 pb-2 font-bold text-center text-white text-md">
                         OU
                    </div>

                    <button type="button" class="w-full px-5 py-2.5 text-md font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                        focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Commencer à écrire !
                    </button>
                </div>

            </div>
        </aside>

        {{-- contenu --}}
        <div class="flex flex-col flex-grow h-full min-h-screen bg-red-100 pt-5">

            {{-- short presentation --}}
            <div class="w-2/4 h-36  ml-20">
                <div class="text-3xl"> {{ config('app.name') }} - Histoire Intéractifs</div>
                <div class="text-xl">
                    Découvrer et/ou participer à la création de nombreux récits du genre que vous souhaités et avec des possibilités de scénarios infini
                </div>
            </div>

            {{-- Hr personnaliser --}}
            <div class="w-full h-8 flex flex-row">
                <div class="flex-grow bg-slate-400 mx-3 my-3 rounded-lg"></div>
                <div class="w-8 bg-slate-400 rounded-full"></div>
                <div class="flex-grow bg-slate-400 mx-3 my-3 rounded-lg"></div>
            </div>

            {{-- section découverte --}}
            <div class="ml-5 text-base capitalize font-bold">
                Découvrez le concept avec ces histoires :
            </div>
            <div></div>

            {{-- Hr personnaliser --}}
            <div class="w-full h-8 flex flex-row">
                <div class="flex-grow bg-slate-400 mx-3 my-3 rounded-lg"></div>
                <div class="w-8 bg-slate-400 rounded-full"></div>
                <div class="flex-grow bg-slate-400 mx-3 my-3 rounded-lg"></div>
            </div>

            {{-- section découverte --}}
            <div class="ml-5 text-base capitalize font-bold">
                Les histoires récement actualiser :
            </div>
            <div></div>

            {{-- Hr personnaliser --}}
            <div class="w-full h-8 flex flex-row">
                <div class="flex-grow bg-slate-400 mx-3 my-3 rounded-lg"></div>
                <div class="w-8 bg-slate-400 rounded-full"></div>
                <div class="flex-grow bg-slate-400 mx-3 my-3 rounded-lg"></div>
            </div>

            {{-- section découverte --}}
            <div class="ml-5 text-base capitalize font-bold">
                Les histoires débutées pas nos auteurs les plus populaires :
            </div>
            <div></div>
        </div>



        {{-- sidebar --}}
        {{-- <aside id="logo-sidebar" class="fixed mt-1.5 top-20 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full  border-r  sm:translate-x-0 bg-gray-800 border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
                <div class="text-white">
                    <h1 > About us </h1>
                </div>

            </div>
         </aside> --}}

         {{-- Content --}}
        </div>



    </div>
</body>
</html>
