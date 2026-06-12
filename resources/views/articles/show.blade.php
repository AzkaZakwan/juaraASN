<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

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
                <div class="h-[300px] md:h-[450px]">
                    <img src="{{ asset('storage/' . $article->image) }}"
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