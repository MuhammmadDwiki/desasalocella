{{-- Desktop Navigation --}}
<nav class="hidden lg:flex justify-center  items-center xl:gap-5">
    <a href="{{ route('beranda') }}" class="text-white no-underline mx-2.5 text-sm transition-colors hover:text-red-500">Home</a>
    
    <div class="relative group">
        <a href="#" class="text-white no-underline mx-2.5 text-sm transition-colors hover:text-red-500">Profil Desa ▼</a>
        <div class="hidden group-hover:block absolute top-full left-0 bg-black/70 p-2.5 rounded min-w-[200px] z-50">
            <a href="{{ route('visi') }}" class="block text-white py-1.5 px-2.5 hover:bg-black/40 hover:text-red-500 rounded">Visi & Misi</a>
            <a href="{{ route('struk') }}" class="block text-white py-1.5 px-2.5 hover:bg-black/40 hover:text-red-500 rounded">Perangkat Desa</a>
        </div>
    </div>

    <div class="relative group">
        <a href="#" class="text-white no-underline mx-2.5 text-sm transition-colors hover:text-red-500">Data Desa ▼</a>
        <div class="hidden group-hover:block absolute top-full left-0 bg-black/70 p-2.5 rounded min-w-[200px] z-50">
            <a href="{{ route('dapen') }}" class="block text-white py-1.5 px-2.5 hover:bg-black/50 hover:text-red-500 rounded">Data Penduduk</a>
        </div>
    </div>  

    <div class="relative group">
        <a href="#" class="text-white no-underline mx-2.5 text-sm transition-colors hover:text-red-500">Kelembagaan ▼</a>
        <div class="hidden group-hover:block absolute top-full left-0 bg-black/70 p-2.5 rounded min-w-[200px] z-50">
            <a href="{{ route('bpd') }}" class="block text-white py-1.5 px-2.5 hover:bg-black/50 hover:text-red-500 rounded">BPD</a>
            <a href="{{ route('karangtrn') }}" class="block text-white py-1.5 px-2.5 hover:bg-black/50 hover:text-red-500 rounded">Karang Taruna</a>
            <a href="{{ route('ketua') }}" class="block text-white py-1.5 px-2.5 hover:bg-black/50 hover:text-red-500 rounded">Ketua RT</a>
            <a href="{{ route('pkk') }}" class="block text-white py-1.5 px-2.5 hover:bg-black/50 hover:text-red-500 rounded">PKK</a>
        </div>
    </div>

    <a href="{{ route('potensi') }}" class="text-white no-underline mx-2.5 text-sm transition-colors hover:text-red-500">Potensi Desa</a>
    <a href="{{ route('layanan') }}" class="text-white no-underline mx-2.5 text-sm transition-colors hover:text-red-500">Layanan</a>
    <a href="{{ route('berita') }}" class="text-white no-underline mx-2.5 text-sm transition-colors hover:text-red-500">Berita</a>
</nav>