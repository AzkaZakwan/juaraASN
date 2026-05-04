<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/auth.js'])

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF5F0]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    <!-- Content -->
    <div class="min-h-screen flex items-center justify-center px-1 pt-20">

        <!-- Left Illustration -->
        <div class="hidden lg:flex w-1/3 justify-center relative">
            <!-- Image -->
            <img src="{{ asset('images/Vector.png') }}" class="w-full max-w-[900px] z-10">
        </div>

        <!-- Right Form -->
        <div class="w-full lg:w-1/4 flex justify-center">
            <div class="bg-white w-full max-w-md py-10 sm:py-16 px-6 sm:px-12 rounded-xl shadow-xl">

                <!-- Title -->
                <div class="flex justify-center">
                    <img src="{{ asset('images/logoraih.png') }}" alt="logo" class="h-18">
                </div>
                <p class="text-center text-500 text-sm mb-6 mt-2">
                    Selamat Datang Kembali
                </p>

                <!-- Form -->
                <form>
                    <!-- Username -->
                    <label class="text-sm">Username / Email</label>
                    <div class="relative mt-1 mb-4">
                        <input type="text"
                            class="w-full border rounded-lg px-4 py-2 pl-10 focus:ring-2 focus:ring-orange-400 outline-none"
                            placeholder="Masukkan Username/Email....">
                        <span class="absolute left-3 top-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </span>
                    </div>

                    <!-- Password -->
                    <label class="text-sm">Password</label>
                    <div class="relative mt-1 mb-2">

                        <input id="password" type="password"
                            class="w-full border rounded-lg px-4 py-2 pl-10 pr-10 focus:ring-2 focus:ring-orange-400 outline-none"
                            placeholder="Masukkan Password....">

                        <span class="absolute left-3 top-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </span>

                        <!-- BUTTON EYE -->
                        <button type="button" id="eyeIcon"
                            class="absolute right-3 top-2.5 text-gray-500 hover:text-gray-700">

                            <!-- Eye Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>

                        <p class="text-xs text-gray-500 mb-4 mt-2">
                            Belum punya akun?
                            <a href="/signupASN" class="text-orange-500">Daftar Sekarang</a>
                        </p>
                        <!-- Links -->
                        <div class="flex justify-between text-xs text-gray-500 mb-4 mt-2">
                            <label class="flex items-center gap-1">
                                <input type="checkbox"> Ingat Saya
                            </label>
                            <a href="#" class="hover:underline">Lupa Password?</a>
                        </div>


                        <!-- Button -->
                        <div class="mt-5">
                            <a href="{{ route('dashboard') }}"
                                class="block w-full bg-orange-500 text-white py-2 rounded-lg text-center hover:bg-orange-600 transition">
                                Log In
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="text-center text-gray-400 text-sm my-4">
                            -------- or --------
                        </div>

                        <!-- Google -->
                        <button type="button" class="w-full border py-2 rounded-lg hover:bg-gray-100 transition">
                            Sign in with Google
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('components.footer')
</body>

</html>
