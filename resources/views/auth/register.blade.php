```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    @vite(['resources/css/app.css', 'resources/js/auth.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5]" style="font-family: 'Poppins', sans-serif;">

    <!-- NAVBAR -->
    <nav id="navbar"
        class="fixed top-0 left-0 w-full z-50 bg-[#FFA35C]/90 backdrop-blur-md text-white shadow-md">

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-3 sm:py-4">

            <div class="h-12 flex items-center overflow-visible">
                <img src="{{ asset('images/juaraASN.png') }}"
                    alt="logo"
                    class="h-12 w-auto scale-125 origin-left transition-all duration-300">
            </div>

        </div>

    </nav>

    <!-- CONTENT -->
    <div
        class="min-h-screen flex flex-col lg:flex-row items-center justify-center gap-10 px-4 sm:px-6 lg:px-16 pt-28 pb-10">

        <!-- LEFT ILLUSTRATION -->
        <div class="hidden lg:flex lg:w-1/3 justify-center">

            <img src="{{ asset('images/Vector.png') }}"
                class="w-full max-w-[500px] xl:max-w-[650px]">

        </div>

        <!-- REGISTER FORM -->
        <div class="w-full lg:w-1/2 flex justify-center">

            <div
                class="bg-white w-full max-w-md rounded-3xl shadow-xl px-6 sm:px-10 py-8 sm:py-10">

                <!-- LOGO -->
                <div class="flex justify-center">
                    <img src="{{ asset('images/juaraASN.png') }}"
                        alt="logo"
                        class="h-16 sm:h-20">
                </div>

                <!-- TITLE -->
                <p class="text-center text-gray-500 text-sm sm:text-base mb-8 mt-3">
                    Silahkan Daftar Diri
                </p>

                <!-- ERROR MESSAGE -->
                @if ($errors->any())
                    <div
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-5">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('register') }}" class="space-y-5">

                    @csrf

                    <!-- NAMA -->
                    <div>

                        <label class="text-sm font-medium">
                            Nama
                        </label>

                        <div class="relative mt-2">

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full border rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-orange-400 outline-none text-sm sm:text-base"
                                placeholder="Masukkan Nama">

                            <span class="absolute left-3 top-3 text-gray-500">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />

                                </svg>

                            </span>

                        </div>

                    </div>

                    <!-- EMAIL -->
                    <div>

                        <label class="text-sm font-medium">
                            Email
                        </label>

                        <div class="relative mt-2">

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full border rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-orange-400 outline-none text-sm sm:text-base"
                                placeholder="Masukkan Email">

                            <span class="absolute left-3 top-3 text-gray-500">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />

                                </svg>

                            </span>

                        </div>

                    </div>

                    <!-- PASSWORD -->
                    <div>

                        <label class="text-sm font-medium">
                            Password
                        </label>

                        <div class="relative mt-2">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="w-full border rounded-xl px-4 py-3 pl-11 pr-11 focus:ring-2 focus:ring-orange-400 outline-none text-sm sm:text-base"
                                placeholder="Masukkan Password">

                            <span class="absolute left-3 top-3 text-gray-500">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />

                                </svg>

                            </span>

                            <button
                                type="button"
                                id="eyeIcon"
                                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                                </svg>

                            </button>

                        </div>

                    </div>

                    <!-- KONFIRMASI PASSWORD -->
                    <div>

                        <label class="text-sm font-medium">
                            Ulangi Password
                        </label>

                        <div class="relative mt-2">

                            <input
                                type="password"
                                id="password2"
                                name="password_confirmation"
                                class="w-full border rounded-xl px-4 py-3 pl-11 pr-11 focus:ring-2 focus:ring-orange-400 outline-none text-sm sm:text-base"
                                placeholder="Masukkan Password">

                            <span class="absolute left-3 top-3 text-gray-500">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />

                                </svg>

                            </span>

                            <button
                                type="button"
                                id="eyeIcon2"
                                class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                                </svg>

                            </button>

                        </div>

                    </div>

                    <!-- BUTTON REGISTER -->
                    <div class="pt-2">
                        <button type="submit" class="block w-full bg-[#FFA35C] hover:bg-orange-600 text-white text-center py-3 rounded-xl font-medium transition hover:shadow-lg">
                            Sign Up
                        </button>
                    </div>

                    <!-- LOGIN LINK -->
                    <div class="text-center text-sm text-gray-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-orange-500 hover:underline font-medium">
                            Login
                        </a>
                    </div>

                </form>

            </div>

        </div>

    </div>

    @include('components.footer')

</body>

</html>
```
