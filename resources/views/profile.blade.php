<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F8F4F1] text-gray-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    {{-- MAIN --}}
    <main class="max-w-6xl mx-auto px-4 sm:px-6 pt-24 pb-12">

        {{-- BACK --}}
        <a href="{{ route('dashboard') }}" class="inline-block hover:scale-110 transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

            </svg>

        </a>

        {{-- TITLE --}}
        <h1 class="text-3xl font-bold mb-10">
            Profil
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

        {{-- PROFILE FORM --}}
        <div class="max-w-2xl mx-auto">

            <form action="{{ route('update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PATCH')

                {{-- NAMA --}}
                <div>

                    <label class="block text-sm mb-2 font-medium">
                        Nama
                    </label>

                    <div class="relative">

                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">

                        {{-- ICON --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />

                        </svg>

                    </div>

                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm mb-2 font-medium">
                        Email
                    </label>

                    <div class="relative">

                        <input type="email" value="{{ Auth::user()->email }}" readonly
                            class="w-full bg-gray-100 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-gray-500 cursor-not-allowed">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />

                        </svg>

                    </div>
                </div>

                {{-- NOMOR HP --}}
                <div>

                    <label class="block text-sm mb-2 font-medium">
                        Nomor HP
                    </label>

                    <div class="relative">

                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                            placeholder="Contoh: 081234567890"
                            class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21L8.7 10.1a11.042 11.042 0 005.2 5.2l.713-1.524a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />

                        </svg>

                    </div>

                </div>

                <a href="{{ route('password.request') }}" class="block w-full text-center text-[#FFA35C]">
                    Reset Password
                </a>

                {{-- ALAMAT --}}
                {{-- <div>

                    <label class="block text-sm mb-2 font-medium">
                        Alamat
                    </label>

                    <div class="relative">

                        <input type="text" value="Mendalo Asri"
                            class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />

                        </svg>

                    </div>

                </div> --}}

                {{-- TTL --}}
                {{-- <div>

                    <label class="block text-sm mb-2 font-medium">
                        Tempat Tanggal Lahir
                    </label>

                    <div class="relative">

                        <input type="text" value="01/01/2001"
                            class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />

                        </svg>

                    </div>

                </div> --}}

                {{-- PASSWORD --}}
                {{-- <div>

                    <label class="block text-sm mb-2 font-medium">
                        Password
                    </label>

                    <div class="relative">

                        <input id="passwordInput" type="password" value="12345678"
                            class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-12 py-3 outline-none focus:ring-2 focus:ring-orange-300"> --}}

                {{-- LOCK ICON --}}
                {{-- <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2h-1V9a5 5 0 00-10 0v2H6a2 2 0 00-2 2v6a2 2 0 002 2zm3-10V9a3 3 0 016 0v2H9z" />

                        </svg> --}}

                {{-- EYE --}}
                {{-- <button type="button" id="togglePassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#FF7A47] transition">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                            </svg>

                        </button> --}}

                {{-- </div>

                    </div> --}}

                {{-- BUTTON --}}
                <div class="pt-4 flex justify-center">

                    <button type="submit"
                        class="bg-[#FFA35C] hover:bg-[#f06a37] transition text-white px-14 py-3 rounded-xl font-medium shadow-md hover:scale-105">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </main>
</body>

</html>
