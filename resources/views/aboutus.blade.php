<x-app-layout>
    @section('content')
        <div class="container mx-auto px-4 py-10">
            <div class="bg-white shadow-lg rounded-2xl p-8">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Tentang Kami</h2>
                
                <div class="space-y-6 text-gray-700 text-justify leading-relaxed">
                    <p>
                        Flows Archive hadir sebagai wadah untuk menyimpan, merawat, dan memperkenalkan kekayaan sejarah serta budaya dari berbagai kategori. Kami berkomitmen untuk menjaga dan melestarikan berbagai koleksi berharga yang mencakup seni, sejarah, ilmu pengetahuan, dan teknologi. Melalui museum ini, kami berharap dapat memberikan kontribusi nyata dalam memperkaya wawasan dan memperluas perspektif tentang dunia di sekitar kita.
                    </p>
                    <p>
                        Dengan berbagai koleksi dari masa lalu hingga masa kini, museum kami menawarkan pengalaman belajar yang mendalam dan penuh makna. Setiap artefak, karya seni, benda bersejarah, dan inovasi teknologi mengisahkan perjalanan manusia dari berbagai sudut pandang, menggambarkan bagaimana perubahan zaman memengaruhi kehidupan sosial, ekonomi, dan budaya.
                    </p>
                    <p>
                        Kami percaya bahwa museum bukan sekadar tempat penyimpanan benda berharga, tetapi juga ruang interaksi dan edukasi bagi masyarakat luas. Oleh karena itu, Flows Archive aktif mengadakan berbagai kegiatan seperti pameran tematik, lokakarya edukatif, dan diskusi interaktif yang melibatkan akademisi, seniman, komunitas budaya, serta para pemerhati sejarah.
                    </p>
                    <p>
                        Selain pameran fisik, Flows Archive juga memanfaatkan teknologi digital untuk menghadirkan pengalaman museum virtual. Dengan mengakses website dan aplikasi kami, pengunjung dapat mengeksplorasi koleksi secara interaktif tanpa harus datang langsung ke lokasi.
                    </p>
                    <p>
                        Flows Archive juga berkolaborasi dengan berbagai institusi pendidikan, lembaga penelitian, dan organisasi kebudayaan untuk menghadirkan program-program berbasis riset. Dengan pendekatan ilmiah yang mendalam, kami memastikan bahwa setiap informasi yang disampaikan memiliki dasar kuat dan dapat dipertanggungjawabkan.
                    </p>
                    <p>
                        Komitmen kami adalah terus berinovasi dalam menyajikan informasi dan pengalaman yang relevan bagi setiap pengunjung. Melalui program edukasi, acara tematik, dan kolaborasi dengan berbagai pihak, kami terus berupaya meningkatkan peran museum sebagai pusat pengetahuan dan apresiasi seni serta budaya.
                    </p>
                    <p>
                        Terima kasih telah menjadi bagian dari perjalanan ini. Kami mengundang Anda untuk menjelajahi setiap koleksi dengan penuh rasa ingin tahu dan semangat belajar. Bersama-sama, mari merawat dan menghargai warisan yang ada agar tetap lestari bagi generasi mendatang.
                    </p>
                </div>

                <div class="mt-10 text-center">
                    <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 bg-gray-700 text-white text-lg font-semibold rounded-xl shadow-md hover:bg-gray-800 transition">
                        Mari Jelajahi Museum Kami
                    </a>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
