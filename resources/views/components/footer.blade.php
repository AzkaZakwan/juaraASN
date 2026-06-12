    <!-- FOOTER -->
    <footer class="bg-[#FFA35C] text-white pt-14 pb-6 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-5 gap-10">

            <!-- Logo -->
            <div class="text-center">
                <div class="flex justify-center">
                    <img src="{{ asset('images/juaraASN.png') }}" alt="logo" class="h-20">
                </div>
                <p class="text-sm opacity-90 mt-2">
                    Platform Try Out ASN Terpercaya untuk masa depan Anda
                </p>
            </div>

            <!-- Navigasi -->
            <div>
                <h3 class="font-semibold mb-3">Navigasi</h3>
                <ul class="space-y-2 text-sm opacity-90">
                    <li>
                        <a href="{{ route('landing') }}" class="hover:underline">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('articles.index') }}" class="hover:underline">
                            Artikel
                        </a>
                    </li>

                    <li>
                         <a href="{{ route('landing') }}#about" class="hover:underline">
                            Tentang Kami
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Layanan -->            
            <div>
                <h3 class="font-semibold mb-3">Layanan</h3>
                <ul class="space-y-2 text-sm opacity-90">
                    <li>
                        <a href="{{ auth()->check() ? route('tryout') : route('login') }}"
                            class="hover:underline">
                            Try Out SKD
                        </a>
                    </li>

                    <li>
                        <a class="hover:underline">
                            Materi 
                        </a>
                    </li>

                    <li>
                        <a href="{{ auth()->check() ? route('riwayat') : route('login') }}"
                            class="hover:underline">
                            Riwayat Try Out
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="font-semibold mb-3">Kontak</h3>
                <ul class="space-y-2 text-sm opacity-90">
                    <li>Email: raihasn@gmail.com</li>
                    <li>WA: 081234567890</li>
                    <li>IG: @raihasn.id</li>
                </ul>
            </div>

            <!-- Info -->
            <div>
                <h3 class="font-semibold mb-3">Info</h3>
                <ul class="space-y-2 text-sm opacity-90">
                    <li>FAQ</li>
                    <li>Privacy Policy</li>
                    <li>Terms</li>
                    <li>Disclaimer</li>
                </ul>
            </div>
        </div>

        <!-- Bottom -->
        <div class="text-center text-sm mt-10 opacity-80">
            © 2026 raihasn.com. All rights reserved.
        </div>
    </footer>