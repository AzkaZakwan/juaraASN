<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>juaraASN</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] antialiased text-gray-800" style="font-family: 'Poppins', sans-serif; scroll-smooth">

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

                <a href="#" class="text-xs sm:text-sm md:text-lg hover:text-orange-300 transition">
                    Paket
                </a>
                <a href="#testimoni" class="text-xs sm:text-sm md:text-lg hover:text-orange-300 transition">
                    Testimoni
                </a>

                <a href="#blog" class="text-xs sm:text-sm md:text-lg hover:text-orange-300 transition">
                    Artikel
                </a>

                <a href="#about" class="hidden sm:block text-sm md:text-lg hover:text-orange-300 transition whitespace-nowrap">
                    Tentang Kami
                </a>
                
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
    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-6 py-32 grid md:grid-cols-2 items-center gap-10">

        <!-- LEFT -->
        <div>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                Bantu Kamu <br>
                Lulus & Raih <br>
                <span class="text-[#FF7A47]">ASN!</span>
            </h1>

            <p class="text-gray-600 mb-6 text-lg">
                Latihan soal, try out dan bimbingan online untuk persiapan seleksi CPNS.
                Ketahui kemampuanmu dan tingkatkan skor secara bertahap.
            </p>

            @guest
                <a href="{{ route('login') }}"
                    class="inline-block bg-[#6FD8CA] text-white px-6 py-3 rounded-xl shadow hover:bg-[#5ACAA1] hover:shadow-lg hover:scale-105 transition">
                    Mulai Try Out
                </a>
            @endguest

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-block bg-[#6FD8CA] text-white px-6 py-3 rounded-xl shadow hover:bg-[#5ACAA1] hover:shadow-lg hover:scale-105 transition">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('tryout') }}"
                        class="inline-block bg-[#6FD8CA] text-white px-6 py-3 rounded-xl shadow hover:bg-[#5ACAA1] hover:shadow-lg hover:scale-105 transition">
                        Mulai Try Out
                    </a>
                @endif
            @endauth
        </div>

        <!-- RIGHT IMAGE -->
        <div class="flex justify-center">
            <img src="{{ asset('images/Vector.png') }}" class="w-[350px] md:w-[450px]">
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 items-center gap-10">

        <!-- IMAGE -->
        <div class="flex justify-center relative">
            <div class="absolute w-64 h-64 bg-orange-500 rounded-full -z-10"></div>
            <img src="{{ asset('images/belajar.png') }}" class="w-[300px]">
        </div>

        <!-- TEXT -->
        <div>
            <h2 class="text-5xl font-bold mb-4">Juara ASN</h2>

            <p class="text-gray-600 mb-4 text-lg text-justify">
                Kami adalah platform try out ASN yang hadir untuk membantu para pejuang
                calon aparatur sipil negara mempersiapkan diri secara lebih efektif, terarah,
                dan percaya diri.
            </p>

            <p class="text-gray-600 mb-4 text-lg text-justify">
                Kami memahami bahwa persaingan dalam seleksi ASN semakin ketat,
                sehingga dibutuhkan latihan yang tidak hanya banyak, tetapi juga
                berkualitas dan relevan dengan standar terbaru.
            </p>

            <p class="text-gray-600 text-lg text-justify">
                Kami percaya bahwa setiap orang memiliki peluang yang sama untuk berhasil,
                selama didukung dengan persiapan yang tepat.
            </p>
        </div>
    </section>

    <!-- FITUR -->
    <section class="relative py-20 px-6 bg-[#FFF9F5]">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 text-center">

            <!-- CARD 1: TRY OUT -->
            <a href="{{ route('tryout') }}"
                class="block bg-[#FFA35C] text-white p-10 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition">

                <div class="flex justify-center text-5xl mb-4">
                    <img src="{{ asset('images/BookPencil.png') }}" alt="Try Out">
                </div>

                <h3 class="text-2xl font-semibold mb-2">Try Out</h3>

                <p class="text-sm opacity-80">
                    Latihan soal CPNS dengan sistem try out untuk mengukur kemampuan dan kesiapanmu.
                </p>
            </a>

            <!-- CARD 2: MATERI -->
            <a href="{{ route('materi') }}"
                class="block bg-[#6FD8CA] text-white p-10 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition">

                <div class="flex justify-center text-5xl mb-4">
                    <img src="{{ asset('images/Reading.png') }}" alt="Materi">
                </div>

                <h3 class="text-2xl font-semibold mb-2">Materi</h3>

                <p class="text-sm opacity-80">
                    Pelajari materi TWK, TIU, dan TKP sebagai bekal menghadapi seleksi ASN.
                </p>
            </a>

            <!-- CARD 3: REVIEW -->
            <a href="{{ route('riwayat') }}"
                class="block bg-[#FFA35C] text-white p-10 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition">

                <div class="flex justify-center text-5xl mb-4">
                    <img src="{{ asset('images/Rules.png') }}" alt="Review">
                </div>

                <h3 class="text-2xl font-semibold mb-2">Review</h3>

                <p class="text-sm opacity-80">
                    Lihat hasil pengerjaan, nilai, dan evaluasi dari try out yang sudah kamu kerjakan.
                </p>
            </a>

        </div>
    </section>

    <!-- TESTIMONI -->
    <section id="testimoni" class="py-20 px-6 bg-[#FFA35C]">

        <div class="max-w-6xl mx-auto text-center mb-10">
            <h2 class="text-5xl font-bold mb-2 text-white">Apa Kata Mereka?</h2>
            <p class="text-white">Cerita dan pengalaman dari para pejuang ASN bersama JuaraASN.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">

            <!-- TESTI CARD -->
            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Soal-soalnya sangat mirip dengan ujian sebenarnya. Pembahasannya mudah dipahami dan membantu saya meningkatkan skor setiap hari.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Andi Saputra</p>
                        <p class="text-xs text-gray-400">Pejuang CPNS 2026</p>
                    </div>
                </div>
            </div>

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Try out yang disediakan sangat membantu mengetahui kelemahan saya. Setelah rutin belajar, nilai terus meningkat hingga lolos seleksi.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/41" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Siti Rahma</p>
                        <p class="text-xs text-gray-400">Pejuang CPNS 2026</p>
                    </div>
                </div>
            </div>

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Fitur review membuat saya bisa mengevaluasi jawaban dengan cepat. Persiapan menjadi lebih terarah dan efektif.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/42" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Dimas Pratama</p>
                        <p class="text-xs text-gray-400">Pejuang CPNS 2026</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 2 -->
        <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto mt-6">

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Materinya lengkap, tampilannya nyaman digunakan, dan saya bisa belajar kapan saja tanpa harus mengikuti kelas tatap muka.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/43" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Rizky Maulana</p>
                        <p class="text-xs text-gray-400">Pejuang CPNS 2026</p>
                    </div>
                </div>
            </div>

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Dashboard hasil try out memudahkan saya memantau perkembangan nilai dan menentukan materi yang harus dipelajari lagi.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/44" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Nadia Putri</p>
                        <p class="text-xs text-gray-400">Fresh Graduate 2026</p>
                    </div>
                </div>
            </div>

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    JuaraASN memberikan pengalaman belajar yang menyenangkan dengan soal berkualitas dan evaluasi yang sangat membantu.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/45" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Fajar Hidayat</p>
                        <p class="text-xs text-gray-400">Pejuang CPNS 2026</p>
                    </div>
                </div>
            </div>

        </div>

    </section>




    <!-- Artikel -->
    <section id="blog" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-6xl mx-auto text-center mb-10">
            <h2 class="text-5xl font-bold mb-2">Artikel</h2>
        </div>

        <div class="space-y-4 max-h-[510px] overflow-y-auto pr-2 pb-4">
            @forelse($articles as $article)

            <div class="bg-white border rounded-xl p-4 flex gap-4 shadow-sm hover:shadow-md transition">

                <div class="w-20 h-20 rounded-md overflow-hidden flex-shrink-0">

                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200"></div>
                    @endif

                </div>

                <div class="flex-1">

                    <p class="text-xs text-gray-500">
                        {{ $article->created_at->format('d M Y') }}
                    </p>

                    <h3 class="font-semibold">
                        {{ $article->title }}
                    </h3>

                    <p class="text-sm text-gray-600">
                        {{ Str::limit(strip_tags($article->content), 100) }}
                    </p>

                    <a href="{{ route('articles.show', $article->slug) }}"
                        class="text-[#FFA35C] text-sm font-semibold mt-2 inline-block">
                        Baca Selengkapnya →
                    </a>

                </div>

            </div>
            @empty
            <div class="bg-white border rounded-xl p-6 text-center text-gray-500">
                Belum ada artikel.
            </div>

            @endforelse
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('articles.index') }}"
                class="inline-block bg-[#FFA35C] text-white px-6 py-3 rounded-xl hover:bg-[#f08b36] transition">
                Lihat Semua Artikel
            </a>

        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="bg-[#FFF9F5] py-16 px-6">
        <div
            class="max-w-5xl mx-auto bg-gradient-to-b from-[#FFA35C] to-[#FFD5B8] text-white rounded-3xl text-center py-12 px-6 shadow-lg">
            <h2 class="text-2xl md:text-4xl font-bold mb-6 leading-relaxed">
                Mulai hari ini, <BR>selangkah lebih dekat jadi ASN</BR>
            </h2>

            @guest
                <a href="{{ route('login') }}"
                    class="inline-block bg-[#6FD8CA] text-white font-semibold px-6 py-3 rounded-xl shadow hover:scale-105 hover:bg-[#5BC4B7] transition">
                    Mulai Belajar
                </a>
            @endguest

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-block bg-white text-[#6FD8CA] font-semibold px-6 py-3 rounded-xl shadow hover:scale-105 hover:bg-orange-100 transition">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('tryout') }}"
                        class="inline-block bg-white text-[#6FD8CA] font-semibold px-6 py-3 rounded-xl shadow hover:scale-105 hover:bg-orange-100 transition">
                        Mulai Belajar
                    </a>
                @endif
            @endauth
        </div>
    </section>
    @include('components.footer')
</body>

</html>
