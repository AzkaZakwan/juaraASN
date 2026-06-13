<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
    <main class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

            {{-- ICON --}}
            <div class="flex justify-center mb-6">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-[#FFA35C]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15.75 9V5.25a3.75 3.75 0 10-7.5 0V9m-1.5 0h10.5A1.5 1.5 0 0118.75 10.5v7.5A1.5 1.5 0 0117.25 19.5H6.75A1.5 1.5 0 015.25 18v-7.5A1.5 1.5 0 016.75 9z" />

                </svg>

            </div>

            <h1 class="text-2xl font-bold text-center mb-3">
                Lupa Password
            </h1>

            <p class="text-center text-gray-600 text-sm leading-6 mb-6">
                Masukkan alamat email yang terdaftar.
                Kami akan mengirimkan link untuk mengatur ulang password Anda.
            </p>

            {{-- STATUS --}}
            @if (session('status'))
                <div class="mb-5 rounded-lg bg-green-100 border border-green-300 text-green-700 text-sm px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('password.email') }}">

                @csrf

                <div class="mb-5">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>

                    <input id="email" type="email" name="email" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" required autofocus
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FFA35C]"
                        placeholder="Masukkan email">

                    @error('email')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <button type="submit"
                    class="w-full bg-[#FFA35C] hover:bg-[#ff9445] text-white font-semibold py-3 rounded-xl transition">
                    Kirim Link Reset Password
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
                        <a href="{{ route('profile') }}" class="text-sm text-gray-500 hover:text-[#FFA35C] transition">
                            ← Kembali ke Profil
                        </a>
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
