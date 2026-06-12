<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Try Out</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F3F3F3]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sideadmin')

    <!-- MOBILE NAVBAR -->
    <div class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FFA35C] shadow-md px-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="openSidebar" class="p-2 rounded-lg hover:bg-white/20 transition text-white">
                ☰
            </button>

            <h1 class="text-lg font-semibold text-white">
                Tambah Try Out
            </h1>
        </div>
    </div>

    <!-- CONTENT -->
    <main class="lg:ml-64 min-h-screen p-4 sm:p-6 lg:p-8 mt-16 lg:mt-0">

        {{-- <div class="text-xs sm:text-sm text-gray-500 mb-2">
            Home > Manajemen Try Out > Tambah Try Out
        </div> --}}

        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-6 sm:mb-8">
            Tambah Try Out
        </h1>
        

        <div class="bg-white rounded-3xl shadow-xl p-5 sm:p-8 lg:p-10 w-full max-w-5xl">

            <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 sm:space-y-8">
                @csrf

                <!-- NAMA -->
                <div class="grid grid-cols-1 lg:grid-cols-[180px_1fr] gap-3 lg:gap-6">
                    <label class="font-semibold text-base sm:text-lg">
                        Nama Try Out
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full bg-white-100 rounded-xl px-4 sm:px-5 py-3 sm:py-4 outline-none focus:ring-2 focus:ring-orange-300"
                        placeholder="Masukkan nama try out" required>
                </div>

                <!-- STATUS -->
                {{-- <div class="grid grid-cols-1 lg:grid-cols-[180px_1fr] gap-3 lg:gap-6">
                    <label class="font-semibold text-base sm:text-lg">
                        Status Try Out
                    </label>

                    <select name="is_premium"
                        class="w-full sm:w-60 bg-white border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">
                        <option value="0">Gratis</option>
                        <option value="1">Premium</option>
                    </select>
                </div> --}}

                <!-- HARGA -->
                <div class="grid grid-cols-1 lg:grid-cols-[180px_1fr] gap-3 lg:gap-6">
                    <label class="font-semibold text-base sm:text-lg">
                        Harga
                    </label>

                    <div>
                        <input type="number" name="price" value="{{ old('price') }}"
                            class="w-full sm:w-60 bg-white border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-orange-300"
                            placeholder="Kosongkan jika gratis">

                        <p class="text-sm text-gray-500 mt-2">
                            Kosongkan atau isi 0 untuk paket gratis. Jika harga lebih dari 0, paket otomatis premium dan pembahasan aktif.
                        </p>
                    </div>
                </div>

                <!-- DURASI -->
                <div class="grid grid-cols-1 lg:grid-cols-[180px_1fr] gap-3 lg:gap-6">
                    <label class="font-semibold text-base sm:text-lg">
                        Durasi
                    </label>

                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', 100) }}"
                        class="w-full sm:w-60 bg-white-100 border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-orange-300"
                        placeholder="100" required>

                    <p class="lg:col-start-2 text-sm text-gray-500">
                        Isi dalam menit, contoh: 100
                    </p>
                </div>

                <!-- GAMBAR -->
                {{-- <div class="grid grid-cols-1 lg:grid-cols-[180px_1fr] gap-3 lg:gap-6">
                    <label class="font-semibold text-base sm:text-lg">
                        Gambar
                    </label>

                    <input type="file" name="image"
                        class="w-full bg-white border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">
                </div> --}}

                <!-- DESKRIPSI -->
                <div class="grid grid-cols-1 lg:grid-cols-[180px_1fr] gap-3 lg:gap-6">
                    <label class="font-semibold text-base sm:text-lg lg:pt-3">
                        Deskripsi
                    </label>

                    <textarea name="description" rows="7"
                        class="w-full bg-white-100 rounded-xl px-4 sm:px-5 py-4 outline-none resize-none focus:ring-2 focus:ring-orange-300"
                        placeholder="Masukkan deskripsi try out">{{ old('description') }}</textarea>
                </div>

                <!-- Checkbox pengaturan -->                
                <div class="grid grid-cols-1 lg:grid-cols-[180px_1fr] gap-3 lg:gap-6">
                    <label class="font-semibold text-base sm:text-lg">
                        Pengaturan
                    </label>

                    <div class="space-y-3">
                        <label class="flex items-center gap-3">
                            <input type="checkbox" name="is_active" class="w-5 h-5" checked>
                            <span>Aktifkan Try Out</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-[180px_1fr] gap-3 lg:gap-6">
                    <label class="font-semibold text-base sm:text-lg">
                        Import Soal Excel
                    </label>

                    <div>
                        <div class="flex flex-col sm:flex-row gap-3 mb-3">

                            <a href="{{ route('packages.template.download') }}"
                                class="text-center bg-white border border-gray-300 text-gray-700 px-5 py-3 rounded-xl hover:bg-gray-100 transition">
                                Download Template Excel
                            </a>

                        </div>

                        <input type="file"
                            name="excel_file"
                            accept=".xlsx,.xls,.csv"
                            class="w-full bg-white border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">

                        <p class="text-sm text-gray-500 mt-2">
                            Opsional. Jika diisi, soal dari Excel otomatis masuk ke bank soal dan langsung terhubung ke paket ini.
                        </p>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 sm:gap-4 pt-4 sm:pt-6">

                    <a href="{{ route('packages.index') }}"
                        class="w-full sm:w-auto text-center bg-red-500 hover:bg-red-600 text-white px-6 sm:px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition">
                        Kembali
                    </a>

                    <button type="submit"
                        class="w-full sm:w-auto bg-[#FF6B1A] hover:bg-[#eb5f12] text-white px-6 sm:px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition">
                        Simpan Try Out
                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>