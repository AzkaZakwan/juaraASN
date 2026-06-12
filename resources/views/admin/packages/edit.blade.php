<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Try Out</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F3F3F3]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sideadmin')

    <div class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FFA35C] shadow-md px-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="openSidebar" class="p-2 rounded-lg hover:bg-white/20 transition text-white">
                ☰
            </button>

            <h1 class="text-lg font-semibold text-white">
                Edit Try Out
            </h1>
        </div>
    </div>

    <main class="lg:ml-64 min-h-screen p-4 sm:p-6 lg:p-8 mt-16 lg:mt-0">

        <h1 class="text-2xl font-bold mb-6">Edit Try Out</h1>

        <form action="{{ route('packages.update', $package->id) }}"
                method="POST"
                class="bg-white rounded-3xl shadow-xl p-5 sm:p-8 lg:p-10 w-full max-w-5xl space-y-6">
            @csrf
            @method('PUT')
            
            {{-- Nama Try Out --}}
            <div>
                <label class="font-semibold">
                    Nama Try Out
                </label>

                <input type="text"
                    name="name"
                    value="{{ old('name', $package->name) }}"
                    class="w-full bg-white-100 rounded-xl px-5 py-4 mt-2 outline-none">
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="font-semibold">
                    Deskripsi
                </label>

                <textarea name="description"
                    rows="6"
                    class="w-full bg-white-100 rounded-xl px-5 py-4 mt-2 outline-none">{{ old('description', $package->description) }}</textarea>
            </div>

            {{-- Harga --}}
            <div>
                <label class="font-semibold">
                    Harga
                </label>

                <input type="number"
                    name="price"
                    value="{{ old('price', $package->price) }}"
                    class="w-full bg-white-100 rounded-xl px-5 py-4 mt-2 outline-none">

                <p class="text-sm text-gray-500 mt-2">
                    Kosongkan atau isi 0 untuk paket gratis.
                </p>
            </div>

            {{-- Durasi --}}
            <div>
                <label class="font-semibold">
                    Durasi (Menit)
                </label>

                <input type="number"
                    name="duration_minutes"
                    value="{{ old('duration_minutes', $package->duration_minutes) }}"
                    class="w-full bg-white-100 rounded-xl px-5 py-4 mt-2 outline-none">
            </div>

            <!-- current image -->
            {{-- @if($package->image)
                <img src="{{ asset('storage/'.$package->image) }}"
                    class="w-32 h-20 object-cover rounded mb-2">
            @endif

            <input type="file" name="image"
                class="w-full border p-2 rounded-lg"> --}}

            {{-- {{-- <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active"
                    {{ $package->is_active ? 'checked' : '' }}>
                Aktif
            </label> --}}

            <div>
                <label class="flex items-center gap-3">

                    <input type="checkbox"
                        name="is_active"
                        class="w-5 h-5"
                        {{ $package->is_active ? 'checked' : '' }}>

                    Aktifkan Try Out

                </label>
            </div>

            {{-- <label class="flex items-center gap-2">
                <input type="checkbox" name="show_explanation"
                    {{ $package->show_explanation ? 'checked' : '' }}>
                Tampilkan Pembahasan
            </label> --}}

            {{-- Tombol --}}
            <div class="flex gap-3">
            <a href="{{ route('packages.index') }}"
                class="bg-red-500 text-white px-6 py-3 rounded-xl">
                Kembali
            </a>

            <button type="submit"
                class="bg-[#FF6B1A] text-white px-6 py-3 rounded-xl">
                Update Try Out
            </button>

        </div>

        </form>

    </main>

</body>
</html>