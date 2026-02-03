<footer class="bg-gradient-to-b from-red-700 to-black pt-10 pb-5 px-5 text-white font-sans mt-20 ">
    <div class="grid grid-cols-1 md:grid-cols-3 max-w-6xl mx-auto gap-5">
        <div class="text-left md:text-left">
            <h4 class="text-white font-bold mb-2.5">Sekilas Salo Cella</h4>
            <ul class="list-none p-0 m-0">
                <li class="my-1.5"><a href="{{ route('sejarah') }}"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Sejarah</a>
                </li>
                <li class="my-1.5"><a href="#"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Profil</a>
                </li>
                <li class="my-1.5"><a href="#"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Peta</a>
                </li>
            </ul>
        </div>
        <div class="text-left md:text-center">
            <h4 class="text-white font-bold mb-2.5">Pemerintah</h4>
            <ul class="list-none p-0 m-0">
                <li class="my-1.5"><a href="{{ route('visi') }}"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Visi
                        Misi</a></li>
                <li class="my-1.5"><a href="{{ route('struk') }}"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Perangkat
                        Desa</a></li>
            </ul>
        </div>
        <div class="text-left md:text-right">
            <h4 class="text-white font-bold mb-2.5">Info Publik</h4>
            <ul class="list-none p-0 m-0">
                <li class="my-1.5"><a href="#"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Pengumuman</a>
                </li>
                <li class="my-1.5"><a href="#"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Infografis</a>
                </li>
                <li class="my-1.5"><a href="#"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Produk
                        Hukum</a></li>
                <li class="my-1.5"><a href="#"
                        class="text-gray-200 no-underline text-base transition-colors hover:text-red-300 hover:underline">Info
                        Berkala</a></li>
            </ul>
        </div>
    </div>
    <div class="text-center mt-6 text-sm text-gray-400 border-t border-white/20 pt-2.5">
        &copy; {{ date('Y') }} Desa Salo Cella. All Rights Reserved.
    </div>
</footer>