<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Try Out - raihASN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .card-shadow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF5F0] antialiased text-slate-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    {{-- Main --}}
    <main class="max-w-7xl mx-auto p-6 mt-6 pt-20">
        
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900">Try Out Gratis - 1</h1>
            <p class="text-slate-500 font-medium">Kerjakan soal dengan jujur dan sungguh-sungguh</p>
            
            <div class="mt-6 inline-block bg-[#FF8B60] text-white px-6 py-2 rounded-full text-2xl font-black shadow-lg">
                00.24.53
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <div class="lg:col-span-8 bg-white rounded-[32px] p-8 card-shadow border border-[#FF7A47]">
                <div class="border-b border-slate-200 pb-4 mb-6">
                    <h2 class="text-xl font-bold text-slate-800">Soal No 1</h2>
                </div>

                <div class="text-slate-700 leading-relaxed mb-8 text-justify font-medium">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Kesadaran pedagang terhadap pentingnya menjaga kebersihan di beberapa pasar tradisional yang berada pada wilayah Jawa Tengah sangat rendah. Data riset kebersihan pasar (RKP) Jawa Tengah menunjukkan bahwa tingkat kesadaran pedagang terhadap kebersihan hanya sebesar 25%. Sejumlah pedagang juga didapat sering membawa sampah rumah tangga mereka ke pasar untuk dibuang di sana. Hal inilah yang sedang dicoba untuk ditangani oleh pemerintah setempat. Gagasan utama paragraf tersebut adalah...
                </div>

                <div class="border-t border-slate-100 pt-6 space-y-4">
                    @foreach(['A. Opsi', 'B. Opsi', 'C. Opsi', 'D. Opsi', 'E. Opsi'] as $opsi)
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="radio" name="jawaban" class="peer appearance-none w-6 h-6 border-2 border-slate-800 rounded-full checked:bg-white checked:border-slate-800 transition-all">
                            <div class="absolute w-3 h-3 bg-slate-800 rounded-full scale-0 peer-checked:scale-100 transition-transform"></div>
                        </div>
                        <span class="text-slate-700 font-bold group-hover:text-[#FF7A47] transition-colors">{{ $opsi }}</span>
                    </label>
                    @endforeach
                </div>

                <div class="mt-12 flex gap-4">
                    <button class="bg-[#A89F94] text-white px-8 py-3 rounded-2xl font-bold shadow-md hover:bg-[#968d83] transition">Sebelumnya</button>
                    <button class="bg-[#595652] text-white px-8 py-3 rounded-2xl font-bold shadow-md hover:bg-[#4a4744] transition">Selanjutnya</button>
                </div>
            </div>

            <div class="lg:col-span-4 bg-white rounded-[32px] p-8 card-shadow border border-[#FF7A47]">
                <div class="text-center mb-6">
                    <span class="text-[#FF8B60] font-bold border-b-2 border-[#FF7A47] pb-1 px-4">Nomor Soal</span>
                </div>

                <div class="grid grid-cols-5 sm:grid-cols-10 lg:grid-cols-5 gap-2 mb-8">
                    @for ($i = 1; $i <= 110; $i++)
                        <button class="aspect-square flex items-center justify-center text-[11px] font-bold border rounded-lg transition
                            {{ $i == 1 ? 'bg-[#FF8B60] border-[#FF8B60] text-white' : 'bg-white border-[#FF8B60] text-[#FF8B60] hover:bg-[#FF7A47]' }}">
                            {{ $i }}
                        </button>
                    @endfor
                </div>

                <div class="space-y-3">
                    <button class="w-full bg-[#FF8B60] text-white py-4 rounded-2xl font-black text-lg shadow-lg hover:scale-[1.02] transition active:scale-95">
                        Selesai
                    </button>
                    <button class="w-full bg-[#FF4757] text-white py-4 rounded-2xl font-black text-lg shadow-lg hover:scale-[1.02] transition active:scale-95">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </main>

</body>
</html>