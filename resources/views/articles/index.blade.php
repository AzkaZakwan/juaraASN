<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                <img src="{{ asset('images/juaraASN.png') }}" alt="logo"
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
                    @if (auth()->user()->role === 'admin')
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
    <div class="max-w-7xl mx-auto px-4 pt-20">
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="inline-block hover:scale-110 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-700 hover:text-[#FFA35C]"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                    </svg>

                </a>
            @else
                <a href="{{ route('dashboard') }}" class="inline-block hover:scale-110 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-700 hover:text-[#FFA35C]"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                    </svg>

                </a>
            @endif
        @else
            <a href="{{ url('/') }}" class="inline-block hover:scale-110 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-700 hover:text-[#FFA35C]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endauth
    </div>
    <main class="max-w-7xl mx-auto px-4 pt-2 pb-12">

        <div class="mb-10">

            <h1 class="text-4xl font-bold">
                Artikel ASN
            </h1>

            <p class="text-gray-500 mt-2">
                Temukan tips, strategi, dan informasi terbaru seputar seleksi ASN.
            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($articles as $article)
                <div
                    class="bg-white rounded-3xl shadow-sm overflow-hidden hover:shadow-lg transition flex flex-col h-full min-h-[430px]">

                    {{-- Gambar --}}
                    <div class="aspect-[16/9] bg-gray-100 overflow-hidden">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-5 flex flex-col flex-1">

                        <p class="text-xs text-gray-400 mb-2">
                            {{ $article->created_at->format('d M Y') }}
                        </p>

                        <h2 class="font-bold text-xl mb-3 line-clamp-2 min-h-[56px]">
                            {{ $article->title }}
                        </h2>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-1">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <a href="{{ route('articles.show', $article->slug) }}"
                            class="inline-block text-[#FFA35C] font-semibold mt-auto">
                            Baca Selengkapnya →
                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center py-12">

                    <h3 class="text-2xl font-bold text-gray-500">
                        Belum ada artikel
                    </h3>

                </div>
            @endforelse

        </div>

        <div class="mt-10">
            {{ $articles->links() }}
        </div>

    </main>

    @include('components.footer')

</body>

</html>
