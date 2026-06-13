<!-- OVERLAY MOBILE -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden">
</div>

<!-- SIDEBAR -->
<aside id="sidebar"
    class="fixed left-0 top-0 h-screen w-64 bg-[#FFA35C] text-white flex flex-col justify-between shadow-xl z-50
    transition-transform duration-300
    -translate-x-full lg:translate-x-0">

    <!-- TOP -->
    <div>

        <!-- LOGO -->
        <div class="px-8 py-8 flex justify-center items-center relative">

            <div class="flex justify-center items-center">
                <img src="{{ asset('images/juaraASN.png') }}" alt="logo"
                    class="h-12 w-auto scale-150 transition-transform duration-300">
            </div>

            <!-- CLOSE BUTTON MOBILE -->
            <button id="closeSidebar"
                class="lg:hidden absolute right-8 text-white text-2xl hover:bg-white/20 rounded-xl transition">
                ✕
            </button>

        </div>

        <!-- MENU -->
        <nav class="px-5 space-y-2 text-sm font-medium">

            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->is('admin/dashboard') ? 'bg-white text-[#FF6B1A] font-bold shadow-md' : 'hover:bg-white/20' }}">
                Dashboard
            </a>

            <a href="{{ route('packages.index') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->is('admin/packages*') ? 'bg-white text-[#FF6B1A] font-bold shadow-md' : 'hover:bg-white/20' }}">
                Manajemen Try Out
            </a>

            <a href="{{ route('questions.index') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->is('admin/questions*') ? 'bg-white text-[#FF6B1A] font-bold shadow-md' : 'hover:bg-white/20' }}">
                Manajemen Bank Soal
            </a>
            <a href="{{ route('admin.articles.index') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->is('admin/articles*') ? 'bg-white text-[#FF6B1A] font-bold shadow-md' : 'hover:bg-white/20' }}">
                Artikel
            </a>
            <a href="{{ route('admin.profileadmin') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('admin.profileadmin') ? 'bg-white text-[#FF6B1A] font-bold shadow-md' : 'hover:bg-white/20' }}">
                Profil
            </a>

        </nav>

    </div>

    <!-- BOTTOM -->
    <div class="p-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center justify-center w-full bg-[#F87171] hover:bg-pink-600 text-white py-3 rounded-2xl text-sm font-semibold shadow-lg hover:shadow-xl hover:scale-[1.02] transition duration-300">
                Log Out
            </button>
        </form>
    </div>
</aside>
