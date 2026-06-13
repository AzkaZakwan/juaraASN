<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F5F5F5] text-gray-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sideadmin')

    <!-- MOBILE NAVBAR -->
    <div
        class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FFA35C] shadow-md px-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="openSidebar" class="p-2 rounded-lg hover:bg-white/20 transition text-white">
                ☰
            </button>

            <h1 class="text-lg font-semibold text-white">
                Profil Admin
            </h1>
        </div>
    </div>

    <main class="lg:ml-64 min-h-screen mt-14 lg:mt-0 p-4 sm:p-6">

        <div class="max-w-4xl mx-auto">

            <h1 class="text-2xl sm:text-3xl font-bold mb-8 text-center">
                Profil Admin
            </h1>

            @if (session('success'))
                <div class="max-w-2xl mx-auto mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="max-w-2xl mx-auto mb-5 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-lg p-6 sm:p-8">

                <form action="{{ route('update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm mb-2 font-medium">
                            Nama
                        </label>

                        <div class="relative">
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm mb-2 font-medium">
                            Email
                        </label>

                        <div class="relative">
                            <input type="email" value="{{ Auth::user()->email }}" readonly
                                class="w-full bg-gray-100 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-gray-500 cursor-not-allowed">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12H8m8 0l-4 4m4-4l-4-4" />
                            </svg>
                        </div>
                        <br>
                        <a href="{{ route('password.request') }}"
                            class="block w-full text-center bg-white text-[#FFA35C]">
                            Reset Password
                        </a>
                    </div>

                    <div class="pt-4 flex justify-center">
                        <button type="submit"
                            class="bg-[#FFA35C] hover:bg-[#ff9445] transition text-white px-14 py-3 rounded-xl font-medium shadow-md hover:scale-105">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
