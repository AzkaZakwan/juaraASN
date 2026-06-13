<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5]" style="font-family: 'Poppins', sans-serif;">

    {{-- CONTENT --}}
    <main class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg px-6 sm:px-8 py-10 text-center">

            {{-- ICON --}}
            <div class="flex justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-24 h-24 text-[#FFA35C]"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-5.197-8.154" />
                </svg>
            </div>

            <p class="text-sm text-gray-800 leading-relaxed mb-6">                
                📧 Email verifikasi telah dikirim <br><br>
                Silakan cek Inbox, folder Spam, atau Junk <br> 
                atau kirim ulang email verifikasi.
                <br><br>
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium text-green-600">
                    Link verifikasi baru telah dikirim ke email Anda.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit"
                    class="w-full bg-[#FFA35C] text-white py-3 rounded-lg font-medium hover:bg-[#ff9445] transition">
                    Kirim Ulang Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf

                <button type="submit"
                    class="text-sm text-gray-500 hover:text-orange-500 transition">
                    Keluar
                </button>
            </form>

        </div>

    </main>

</body>
</html>