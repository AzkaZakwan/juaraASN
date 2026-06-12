<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F3F3F3]" style="font-family: 'Poppins', sans-serif;">

    <!-- SIDEBAR -->
    @include('components.sideadmin')

    <!-- MOBILE NAVBAR -->
    <div
        class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FFA35C] shadow-md px-4 flex items-center justify-between">

        <div class="flex items-center gap-3">

            <!-- BUTTON -->
            <button id="openSidebar" class="p-2 rounded-lg hover:bg-white/20 transition">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-white">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />

                </svg>

            </button>
            <!-- TITLE -->
            <h1 class="text-lg font-semibold text-white">
                Dashboard
            </h1>
        </div>
    </div>
    <!-- CONTENT -->
    <main class="lg:ml-64 min-h-screen p-4 sm:p-6 lg:p-8 mt-16 lg:mt-0">

        <!-- HEADER -->
        <div class="mb-10">
            <h2 class="text-5xl font-bold leading-tight">
                Hi, Admin
            </h2>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 gap-8">

            <div class="space-y-8">

                <!-- CARD WRAP -->
                <div class="grid md:grid-cols-2 gap-8">

                    <!-- CARD -->
                    <div
                        class="bg-white rounded-3xl shadow-lg p-6 flex items-center gap-5 hover:scale-[1.02] transition">

                        <!-- ICON -->
                        <div class="w-16 h-16 rounded-2xl bg-[#FF6B1A] flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>

                        <!-- TEXT -->
                        <div>
                            <h2 class="text-2xl font-bold">
                                Total User
                            </h2>

                            <p class="text-5xl font-bold text-[#FF6B1A]">
                                {{$totalUsers}}
                            </p>
                        </div>
                    </div>

                    <!-- CARD -->
                    <div
                        class="bg-white rounded-3xl shadow-lg p-6 flex items-center gap-5 hover:scale-[1.02] transition">

                        <div class="w-16 h-16 rounded-2xl bg-[#FF6B1A] flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold">
                                Total Tryout
                            </h2>

                            <p class="text-5xl font-bold text-[#FF6B1A]">
                                {{$totalTryouts}}
                            </p>
                        </div>
                    </div>

                </div>

                <!-- PREMIUM USER -->
                <div
                    class="bg-white rounded-3xl shadow-lg p-6 flex items-center gap-5 hover:scale-[1.02] transition max-w-md">

                    <div class="w-16 h-16 rounded-2xl bg-[#FF6B1A] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold">
                            User beli paket
                        </h2>

                        <p class="text-5xl font-bold text-[#FF6B1A]">
                            {{ $totalPremiumUsers }}
                        </p>
                    </div>

                </div>

                <!-- USER TRYOUT -->
                <div class="bg-white rounded-3xl shadow-lg p-6 h-[300px]">

                    <h2 class="text-2xl font-bold mb-6">
                        Banyak paket dikerjakan
                    </h2>

                    <!-- ISI CHART -->
                    <div class="space-y-4">

                        @forelse($attemptChart as $item)
                            @php
                                $max = max($attemptChart->max('finished_attempts_count'), 1);
                                $percent = ($item->finished_attempts_count / $max) * 100;
                            @endphp

                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-semibold text-gray-700">
                                        {{ $item->name }}
                                    </span>

                                    <span class="text-gray-500">
                                        {{ $item->finished_attempts_count }}x
                                    </span>
                                </div>

                                <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden">
                                    <div class="bg-[#FFA35C] h-4 rounded-full"
                                        style="width: {{ $percent }}%">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="w-full h-[220px] bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400">
                                Belum ada data pengerjaan try out.
                            </div>
                        @endforelse

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            {{-- <div>

                <div class="bg-white rounded-3xl shadow-lg p-6 h-full min-h-[600px]">

                    <h2 class="text-2xl font-bold mb-6">
                        Pertumbuhan Pengguna
                    </h2>

                    <!-- CHART -->
                    <div
                        class="w-full h-[500px] bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400">

                        Grafik Pengguna

                    </div>

                </div>

            </div> --}}

        </div>

    </main>

</body>

</html>
