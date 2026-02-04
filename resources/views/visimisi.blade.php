@extends('layouts.app')

@section('title', 'Visi & Misi - Desa Salo Cella')

@section('content')


    <section class="py-10"></section>

    {{-- Bagian Visi --}}
    <section class="px-5 py-8">
        <div class="bg-white rounded-lg p-6 shadow-md max-w-6xl mx-auto mb-6">
            <h2 class="text-2xl font-bold text-red-600 mb-4">Visi</h2>
            <p class="text-gray-700 leading-relaxed">"Mewujudkan masyarakat desa yang sejahtera dan damai melalui
                program-program yang berkelanjutan."</p>
        </div>

        {{-- Bagian Misi --}}
        <div class="bg-white rounded-lg p-6 shadow-md max-w-6xl mx-auto text-justify">
            <h2 class="text-2xl font-bold text-red-600 mb-4">Misi</h2>
            <ol class="list-decimal pl-6 space-y-3 text-gray-700 leading-relaxed">
                <li>Melakukan reformasi kinerja aparatur pemerintah desa guna meningkatkan kualitas pelayanan kepada
                    masyarakat yang prima, yaitu cepat, tepat, dan benar, serta menyelenggarakan pemerintah desa secara
                    transparan, efisien, akuntabel, dan bertanggung jawab sesuai dengan perundang-undangan.</li>
                <li>Peningkatan/pembangunan di seluruh wilayah Desa Salo Cella, baik desa, pemukiman, dan peningkatan
                    sarana
                    prasarana pertanian, perkebunan, perikanan, dan peternakan.</li>
                <li>Meningkatkan sarana dan prasarana dari segi fisik, ekonomi, pendidikan, kesehatan, olahraga, dan
                    kebudayaan.</li>
                <li>Meningkatkan kesejahteraan masyarakat desa dengan mewujudkan usaha milik desa (BUMDes) dan program
                    lain
                    untuk membuka lapangan kerja bagi masyarakat desa.</li>
                <li>Menjalin komunikasi yang harmonis antara masyarakat, pemerintah dan lembaga desa, saling menghormati
                    dalam kehidupan berbudaya.</li>
                <li>Memberdayakan semua potensi yang ada pada masyarakat yang meliputi:
                    <ul class="list-disc pl-6 mt-2 space-y-1">
                        <li>Pemberdayaan sumber daya manusia (SDM)</li>
                        <li>Pemberdayaan sumber daya alam (SDA)</li>
                        <li>Pemberdayaan ekonomi masyarakat</li>
                    </ul>
                </li>
            </ol>
        </div>
    </section>

    <section class="px-5 py-4 max-w-6xl mx-auto text-justify">
        <h3 class="text-xl font-bold text-gray-800 mb-3">Asal Usul Desa</h3>
        <p class="text-gray-700 leading-relaxed mb-6">
            Desa Salo Cella berdiri sejak puluhan tahun yang lalu sebagai salah satu pemukiman tertua di wilayah
            Kecamatan
            Muara Badak, Kabupaten Kutai Kartanegara.
            Awalnya wilayah ini hanya berupa hamparan lahan hutan dan rawa yang dialiri oleh beberapa anak sungai kecil.
            Sekelompok masyarakat dari daerah pesisir dan pedalaman datang untuk bermukim karena tanahnya subur dan
            dekat
            dengan sumber air.
            Nama "Salo Cella" sendiri berasal dari bahasa daerah setempat yang berarti "air yang menyejukkan,"
            menggambarkan kondisi geografis desa yang dikelilingi sungai dan sumber air alami.
        </p>

        <h3 class="text-xl font-bold text-gray-800 mb-3">Perkembangan Desa</h3>
        <p class="text-gray-700 leading-relaxed mb-6">
            Pada awalnya, masyarakat Salo Cella hidup dari hasil bercocok tanam padi ladang, menanam sayur-sayuran,
            serta menangkap ikan di sungai dan rawa. Seiring berjalannya waktu, pemerintah mulai memperhatikan potensi
            wilayah ini.
            Program pembangunan desa dimulai dengan membuka akses jalan, pembangunan jembatan, serta fasilitas umum
            seperti
            sekolah dan posyandu.
            Tahun demi tahun, Desa Salo Cella semakin berkembang menjadi pusat kegiatan ekonomi kecil menengah di
            wilayah
            sekitarnya.
            Perkebunan kelapa sawit, karet, dan hortikultura menjadi sumber pendapatan tambahan bagi warga.
            Selain itu, beberapa kelompok masyarakat membentuk usaha perikanan dan peternakan rakyat.
            Kehidupan sosial pun mulai terbentuk dengan kuatnya semangat gotong royong antar warga,
            terutama dalam pembangunan fasilitas umum seperti masjid, jalan desa, dan irigasi pertanian.
        </p>

        <h3 class="text-xl font-bold text-gray-800 mb-3">Kehidupan Masyarakat</h3>
        <p class="text-gray-700 leading-relaxed mb-6">
            Masyarakat Desa Salo Cella dikenal ramah, terbuka, dan menjunjung tinggi nilai-nilai kekeluargaan.
            Tradisi gotong royong masih sangat dijaga, terutama dalam kegiatan adat, pembangunan, dan acara
            kemasyarakatan.
            Upacara adat seperti syukuran panen, selamatan sungai, dan kenduri kampung masih rutin dilaksanakan
            sebagai wujud rasa syukur kepada Tuhan Yang Maha Esa atas hasil bumi yang melimpah.
            <br><br>
            Kini, Desa Salo Cella terus bertransformasi menuju desa yang lebih maju dengan tetap mempertahankan kearifan
            lokalnya.
            Pemerintah desa bersama masyarakat bekerja sama dalam berbagai program seperti pengembangan UMKM,
            pelestarian
            lingkungan,
            serta digitalisasi data desa agar pelayanan publik menjadi lebih efisien dan transparan.
        </p>
        <h3 class="text-xl font-bold text-gray-800 mb-3">Kesimpulan</h3>
        <p class="text-gray-700 leading-relaxed mb-6">
            Desa Salo Cella merupakan cerminan desa yang tumbuh dari semangat gotong royong dan kebersamaan
            masyarakatnya.
            Dari sebuah pemukiman sederhana di tepi sungai, kini telah berkembang menjadi desa yang berdaya saing dan
            mandiri.
            Dengan kekayaan alam yang melimpah dan masyarakat yang berbudaya, Salo Cella memiliki potensi besar
            untuk menjadi salah satu desa percontohan dalam pengelolaan sumber daya dan pelestarian tradisi di Kecamatan
            Muara Badak.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-8">
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Peta Administrasi Desa</h3>
                <img src="{{ asset('images/petadesa.png') }}" alt="Peta Administrasi" class="w-full rounded-lg shadow-md">
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Peta Batas RT</h3>
                <img src="{{ asset('images/petabatasrt.png') }}" alt="Peta RT" class="w-full rounded-lg shadow-md">
            </div>
        </div>
    </section>


@endsection