<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5]" style="font-family: 'Poppins', sans-serif;">

    <!-- NAVBAR -->
    <nav id="navbar"
        class="fixed top-0 left-0 w-full z-50 bg-[#FFA35C]/90 backdrop-blur-md text-white 
           shadow-md transition-all duration-300 will-change-transform">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 
                flex justify-between items-center py-4 transition-all duration-300">

            <!-- LOGO -->
            <div class="h-12 flex items-center overflow-visible">
                <img src="{{ asset('images/juaraASN.png') }}"
                    alt="logo"
                    class="h-12 w-auto scale-125 origin-left transition-all duration-300">
            </div>

            <!-- MENU -->
            <div class="flex items-center gap-3 sm:gap-5 md:gap-6">
                @guest
                    <a href="{{ route('login') }}"
                        class="bg-[#6FD8CA] px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm md:text-base text-white hover:bg-[#5ACAA1] transition">
                        Login
                    </a>
                @endguest

                @auth
                    @if(auth()->user()->role === 'admin')
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-[#6FD8CA] px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm md:text-base text-white hover:bg-[#5ACAA1] transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-[#6FD8CA] px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm md:text-base text-white hover:bg-[#5ACAA1] transition">
                                Logout
                            </button>
                        </form>
                    @endif
                @endauth


            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 pt-24 pb-12">

        {{-- BACK --}}
        <a href="{{ route('articles.index') }}"
            class="inline-flex items-center gap-2 text-[#FFA35C] font-semibold mb-8 hover:underline">

            ← Kembali ke Artikel

        </a>

        {{-- ARTICLE --}}
        <article class="bg-white rounded-3xl shadow-sm overflow-hidden">

            {{-- IMAGE --}}
            @if($article->image)
                <div class="aspect-[16/7] rounded-3xl overflow-hidden mb-8">
                    <img src="{{ asset('storage/'.$article->image) }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-6 md:p-10">

                {{-- DATE --}}
                <p class="text-sm text-gray-400 mb-3">
                    {{ $article->created_at->format('d F Y') }}
                </p>

                {{-- TITLE --}}
                <h1 class="text-3xl md:text-5xl font-bold mb-6">
                    {{ $article->title }}
                </h1>

                {{-- CONTENT --}}
                <div class="prose max-w-none prose-orange">
                    {!! nl2br(e($article->content)) !!}
                </div>

            </div>

        </article>

    </main>

    @include('components.footer')

</body>
</html>