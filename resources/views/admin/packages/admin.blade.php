<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Try Out</title>

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
                Manajemen Try Out
            </h1>
        </div>
    </div>

    <!-- CONTENT -->
    <main class="lg:ml-64 min-h-screen p-4 sm:p-6 lg:p-8 mt-16 lg:mt-0">

        <div class="bg-white rounded-3xl shadow-xl p-5 sm:p-8 lg:p-10 w-full max-w-5xl mx-auto">

            <h1 class="text-4xl font-bold mb-8">
                Daftar Try Out
            </h1>

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">

                @forelse ($packages as $package)
                    <div class="bg-[#FFA35C] rounded-xl p-5 flex items-center justify-between shadow-md hover:scale-[1.01] transition">

                        <div class="text-white">
                            <h2 class="font-bold text-lg">
                                {{ $package->name }}
                            </h2>

                            <div class="mb-1">
                                <span class="text-xs font-bold px-3 py-1 rounded-full
                                    {{ $package->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>

                            <p class="text-sm">
                                {{ $package->questions_count }} Soal
                                {{ $package->duration_minutes ?? 100 }} Menit ·
                                {{ $package->price == 0 ? 'Gratis' : 'Premium · Rp ' . number_format($package->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex gap-2">

                            <a href="{{ route('packages.edit', $package->id) }}"
                                class="bg-white text-gray-800 w-10 h-10 rounded-lg flex items-center justify-center hover:scale-110 transition">
                                ✎
                            </a>

                            <a href="{{ route('packages.questions', $package->id) }}"
                                class="bg-white text-gray-800 px-3 h-10 rounded-lg flex items-center justify-center hover:scale-110 transition text-sm font-semibold">
                                Soal
                            </a>

                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-10">
                        Belum ada paket try out.
                    </div>
                @endforelse

            </div>

            @if ($packages->hasPages())
                <div class="flex justify-center items-center gap-3 mt-8">

                    @if ($packages->onFirstPage())
                        <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg">
                            Previous
                        </span>
                    @else
                        <a href="{{ $packages->previousPageUrl() }}"
                            class="px-4 py-2 bg-white border text-gray-700 rounded-lg hover:bg-gray-100">
                            Previous
                        </a>
                    @endif

                    <span class="text-sm text-gray-500">
                        Page {{ $packages->currentPage() }} of {{ $packages->lastPage() }}
                    </span>

                    @if ($packages->hasMorePages())
                        <a href="{{ $packages->nextPageUrl() }}"
                            class="px-4 py-2 bg-white border text-gray-700 rounded-lg hover:bg-gray-100">
                            Next
                        </a>
                    @else
                        <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg">
                            Next
                        </span>
                    @endif

                </div>
            @endif

            <div class="flex justify-end mt-8">
                <a href="{{ route('packages.create') }}"
                    class="bg-[#FFA35C] hover:bg-[#de8f52] text-white px-6 py-2 rounded-xl shadow-md hover:shadow-lg transition">
                    + Try Out
                </a>
            </div>

        </div>

    </main>

</body>
</html>