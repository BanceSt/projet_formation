<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://kit.fontawesome.com/89eaa3121d.js" crossorigin="anonymous"></script>
    <title>@yield('title', "Home")</title>
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
                    <a href="{{route('register')}}" class="text-2xl font-semibold whitespace-nowrap"> Sign In </a>
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
            @yield("content")
        </div>


    </div>


    @livewireScripts
</body>
</html>
