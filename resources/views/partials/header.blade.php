<header
    class="absolute top-0 left-0 w-full flex justify-between items-center px-5 md:px-10 py-2.5 bg-black/40 text-white z-[1000]">
    {{-- Logo & Title --}}
    <div class="flex items-center">
        <img src="{{ asset('images/logodesa.png') }}" alt="Logo" class="h-10 md:h-12 mr-3 md:mr-4">
        <div class="leading-tight">
            <div class="text-base md:text-lg font-bold">Desa Sallo Cela</div>
            <div class="text-xs md:text-sm mt-0.5 hidden sm:block">
                Kec. Muara Badak, Kab. Kutai Kartanegara,<br>
                Prov. Kalimantan Timur
            </div>
        </div>
    </div>

    {{-- Desktop Navigation --}}
    <div class="hidden lg:block">
        @include('partials.navigation')
    </div>

    {{-- Mobile Hamburger Button --}}
    <button id="mobileMenuBtn" class="lg:hidden text-white focus:outline-none z-[1001]" aria-label="Toggle menu">
        <svg id="hamburgerIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Mobile Menu Overlay --}}
    <div id="mobileMenu"
        class="fixed inset-0 bg-black/95 transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden z-[999]">
        <nav class="flex flex-col items-start p-8 mt-20 space-y-4 overflow-y-auto h-full">
            <a href="{{ route('beranda') }}"
                class="text-white text-lg font-medium hover:text-red-500 transition-colors w-full py-2">Home</a>

            {{-- Profil Desa Dropdown --}}
            <div class="w-full">
                <button
                    class="mobile-dropdown-btn text-white text-lg font-medium hover:text-red-500 transition-colors w-full text-left py-2 flex justify-between items-center">
                    <span>Profil Desa</span>
                    <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="mobile-dropdown-content hidden pl-4 mt-2 space-y-2">
                    <a href="{{ route('visi') }}"
                        class="block text-white/80 hover:text-red-500 transition-colors py-1">Visi & Misi</a>
                    <a href="{{ route('struk') }}"
                        class="block text-white/80 hover:text-red-500 transition-colors py-1">Perangkat Desa</a>
                </div>
            </div>

            {{-- Data Desa Dropdown --}}
            <div class="w-full">
                <button
                    class="mobile-dropdown-btn text-white text-lg font-medium hover:text-red-500 transition-colors w-full text-left py-2 flex justify-between items-center">
                    <span>Data Desa</span>
                    <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="mobile-dropdown-content hidden pl-4 mt-2 space-y-2">
                    <a href="{{ route('dapen') }}"
                        class="block text-white/80 hover:text-red-500 transition-colors py-1">Data Penduduk</a>
                </div>
            </div>

            {{-- Kelembagaan Dropdown --}}
            <div class="w-full">
                <button
                    class="mobile-dropdown-btn text-white text-lg font-medium hover:text-red-500 transition-colors w-full text-left py-2 flex justify-between items-center">
                    <span>Kelembagaan</span>
                    <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="mobile-dropdown-content hidden pl-4 mt-2 space-y-2">
                    <a href="{{ route('bpd') }}"
                        class="block text-white/80 hover:text-red-500 transition-colors py-1">BPD</a>
                    <a href="{{ route('karangtrn') }}"
                        class="block text-white/80 hover:text-red-500 transition-colors py-1">Karang Taruna</a>
                    <a href="{{ route('ketua') }}"
                        class="block text-white/80 hover:text-red-500 transition-colors py-1">Ketua RT</a>
                    <a href="{{ route('pkk') }}"
                        class="block text-white/80 hover:text-red-500 transition-colors py-1">PKK</a>
                </div>
            </div>

            <a href="{{ route('potensi') }}"
                class="text-white text-lg font-medium hover:text-red-500 transition-colors w-full py-2">Potensi Desa</a>
            <a href="{{ route('layanan') }}"
                class="text-white text-lg font-medium hover:text-red-500 transition-colors w-full py-2">Layanan</a>
            <a href="{{ route('berita') }}"
                class="text-white text-lg font-medium hover:text-red-500 transition-colors w-full py-2">Berita</a>
        </nav>
    </div>
</header>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const hamburgerIcon = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('translate-x-full');
        hamburgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    });

    // Mobile dropdown toggles
    const dropdownBtns = document.querySelectorAll('.mobile-dropdown-btn');
    dropdownBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const content = btn.nextElementSibling;
            const arrow = btn.querySelector('svg');
            content.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });
    });

    // Close mobile menu when clicking on a link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
            hamburgerIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    });
</script>