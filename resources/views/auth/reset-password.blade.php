<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth.js'])

    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F7F7F7]" style="font-family: 'Poppins', sans-serif;">

    {{-- HEADER --}}
    {{-- <div class="w-full h-16 bg-[#FFA35C] flex items-center shadow-sm">
        <div class="max-w-6xl mx-auto w-full px-6">
            <img src="{{ asset('images/juaraASN.png') }}"
                alt="JuaraASN"
                class="h-10 w-auto">
        </div>
    </div> --}}

    {{-- CONTENT --}}
    <main class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

            {{-- ICON --}}
            <div class="flex justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-[#FFA35C]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M16.5 10.5V7.5a4.5 4.5 0 10-9 0v3m-1.5 0h12A1.5 1.5 0 0119.5 12v7.5A1.5 1.5 0 0118 21H6A1.5 1.5 0 014.5 19.5V12A1.5 1.5 0 016 10.5z" />
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-center mb-3">
                Reset Password
            </h1>

            <p class="text-center text-gray-600 text-sm leading-6 mb-6">
                Silakan masukkan password baru untuk akun Anda
            </p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- EMAIL --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>

                    <input id="email" type="email" name="email"
                        value="{{ old('email', $request->email ?? (auth()->check() ? auth()->user()->email : '')) }}"
                        required autofocus autocomplete="username"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FFA35C]"
                        placeholder="Masukkan email">

                    @error('email')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru
                    </label>

                    <div class="relative">

                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-[#FFA35C]"
                            placeholder="Masukkan password baru">

                        <!-- EYE ICON -->
                        <button type="button" id="eyeIcon"
                            class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                            </svg>

                        </button>

                    </div>

                    @error('password')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- CONFIRM PASSWORD --}}
                <div class="mb-5">
                    <label for="password2" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password
                    </label>

                    <div class="relative">
                        <input id="password2" type="password" name="password_confirmation" required
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-[#FFA35C]"
                            placeholder="Ulangi password baru">

                        <button type="button" id="eyeIcon2"
                            class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                            </svg>
                        </button>
                    </div>

                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#FFA35C] hover:bg-[#ff9445] text-white font-semibold py-3 rounded-xl transition">
                    Reset Password
                </button>
            </form>

            <div class="mt-6 text-center">

                @auth

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.profileadmin') }}"
                            class="text-sm text-gray-500 hover:text-[#FFA35C] transition">
                            ← Kembali ke Profil
                        </a>
                    @else
                        <button type="button" onclick="history.back()"
                            class="text-sm text-gray-500 hover:text-[#FFA35C] transition">
                            ← Kembali
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-[#FFA35C] transition">
                        ← Kembali ke Login
                    </a>

                @endauth

            </div>

        </div>

    </main>

</body>

</html>
