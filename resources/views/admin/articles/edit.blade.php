<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F5F5F5]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sideadmin')
    <!-- MOBILE NAVBAR -->
    <div class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FFA35C] shadow-md px-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="openSidebar" class="p-2 rounded-lg hover:bg-white/20 transition text-white">
                ☰
            </button>

            <h1 class="text-3xl font-bold mb-8">
                Edit Artikel
            </h1>
        </div>
    </div>

    <main class="lg:ml-64 min-h-screen p-6">

        <h1 class="text-3xl font-bold mb-8">
            Tambah Artikel
        </h1>

        <div class="bg-white rounded-3xl shadow-lg p-8 max-w-5xl">

            <form action="{{ route('admin.articles.update', $article->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Judul Artikel
                    </label>

                    <input type="text"
                        name="title"
                        value="{{ old('title', $article->title) }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-300"
                        required>

                </div>

                {{-- Gambar --}}
                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Gambar Artikel
                    </label>

                    <input type="file"
                        name="image"
                        class="w-full border rounded-xl px-4 py-3">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}"
                            class="mt-4 w-48 rounded-xl border">
                    @endif

                </div>

                {{-- Isi --}}
                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Isi Artikel
                    </label>

                    <textarea name="content"
                        rows="12"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-300"
                        required>{{ old('content', $article->content) }}</textarea>

                </div>

                {{-- Publish --}}
                <div class="mb-8">

                    <label class="flex items-center gap-3">

                        <input type="checkbox"
                            name="is_published"
                            {{ $article->is_published ? 'checked' : '' }}>

                        <span>
                            Publish Artikel
                        </span>

                    </label>

                </div>

                <div class="flex justify-end gap-3">

                    <a href="{{ route('admin.articles.index') }}"
                        class="bg-red-500 text-white px-6 py-3 rounded-xl hover:bg-red-600">
                        Kembali
                    </a>

                    <button type="submit"
                        class="bg-[#FFA35C] text-white px-6 py-3 rounded-xl hover:bg-[#f08b36]">
                        Update Artikel
                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>