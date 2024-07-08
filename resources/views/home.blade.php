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
    <div class="min-h-screen">
        {{-- Navbar --}}
        <nav class="bg-gray-900 border-gray-200 ">
            <div class="max-w-full flex flex-wrap items-center justify-between p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Flowbite</span>
                </a>
                <div class="flex items-center space-x-3 rtl:space-x-reverse text-white">
                    <a href="" class="text-2xl font-semibold whitespace-nowrap"> Sign In </a>
                    <span class="text-2xl font-semibold whitespace-nowrap"> /  </span>
                    <a href="" class="text-2xl font-semibold whitespace-nowrap"> Sign Up </a>
                    <button type="button" class="inline-flex text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-2xl px-2.5 py-1 text-center me-2">
                        NEW
                        <i class="fa-solid fa-pen text-base ps-2 self-center"></i>
                    </button>
                </div>


            </div>
        </nav>

    </div>
</body>
</html>
