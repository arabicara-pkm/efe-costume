<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EFECostume - Kostum Tari Terbaik</title>
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        .serif {
            font-family: 'Playfair Display', serif;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom Colors */
        .text-primary {
            color: #be123c;
        }

        .bg-primary {
            background-color: #be123c;
        }

        .bg-secondary {
            background-color: #fda4af;
        }

        .bg-secondary-light {
            background-color: #fff1f2;
        }

        .text-dark {
            color: #1f2937;
        }

        .bg-dark {
            background-color: #1f2937;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex flex-col text-dark" id="body-container">

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then(registration => {
                    console.log('SW registered: ', registration);
                }).catch(registrationError => {
                    console.log('SW registration failed: ', registrationError);
                });
            });
        }
    </script>

    <header id="main-navbar" class="bg-white sticky top-0 z-50 shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2 cursor-pointer" onclick="handleNav('hero')">
                <span class="text-xl font-extrabold text-dark serif">EFECostume</span>
                <i data-lucide="crown" class="w-6 h-6 text-primary"></i>
            </div>

            <div id="nav-links" class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="#hero" class="hover:text-primary transition-colors">Beranda</a>
                <a href="#catalog" class="hover:text-primary transition-colors">Katalog</a>
                <a href="#about" class="hover:text-primary transition-colors">Tentang</a>
                <a href="{{ route('login') }}" class="hover:text-primary transition-colors font-bold text-primary">Masuk
                    / Daftar</a>
            </div>

            <div class="flex items-center space-x-4">
                <i data-lucide="menu" class="w-6 h-6 md:hidden cursor-pointer"></i>
            </div>
        </nav>
    </header>

    <main id="app-content" class="flex-1">
        <section id="hero" class="relative bg-dark h-[500px] flex items-center justify-center p-8 overflow-hidden">
            <div class="absolute inset-0 opacity-80"
                style="background-image: url('{{ asset('images/backgroundtari.jpg') }}'); background-size: cover; background-position: center;">
            </div>
            <div class="absolute inset-0" style="background-color: rgba(60, 0, 0, 0.5);"></div>

            <div
                class="relative max-w-7xl mx-auto flex flex-col items-center text-center justify-center w-full z-10 text-white">
                <div class="max-w-2xl space-y-4">
                    <h1 class="text-4xl md:text-5xl font-extrabold serif leading-tight">
                        Temukan Keindahan Tari Anda. Sewa Kostum Terbaik.
                    </h1>
                    <p class="text-lg text-gray-200">
                        Koleksi terlengkap kostum tari tradisional, terawat, dan siap pakai.
                    </p>
                    <button
                        class="mt-4 px-6 py-3 bg-secondary text-dark font-semibold rounded-lg hover:bg-[#ff8478] transition-colors"
                        onclick="handleNav('catalog')">
                        Lihat Katalog
                    </button>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20 mb-16">
            <div class="bg-white p-6 rounded-xl card shadow-lg">
                <div class="flex space-x-2 border border-gray-300 rounded-lg overflow-hidden">
                    <input type="text" placeholder="Cari Kostum / Jenis Tari..."
                        class="flex-1 p-3 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button class="px-6 bg-primary text-white hover:bg-dark transition-colors font-medium">Cari</button>
                </div>
                <div class="flex flex-wrap gap-4 mt-4 text-sm font-medium">
                    <span
                        class="px-3 py-1 bg-secondary-light text-primary rounded-full cursor-pointer hover:bg-secondary">Tari
                        Bali</span>
                    <span
                        class="px-3 py-1 bg-secondary-light text-primary rounded-full cursor-pointer hover:bg-secondary">Tari
                        Jawa</span>
                    <span
                        class="px-3 py-1 bg-secondary-light text-primary rounded-full cursor-pointer hover:bg-secondary">Tarian
                        Sunda</span>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold text-center mb-10 serif">Fitur Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-xl card flex items-start space-x-4 bg-red-100 text-red-700">
                    <i data-lucide="credit-card" class="w-8 h-8 flex-shrink-0"></i>
                    <div>
                        <h3 class="font-semibold text-xl mb-1">QRIS Mudah</h3>
                        <p class="text-sm opacity-90">Pembayaran QRIS & Transfer Bank.</p>
                    </div>
                </div>
                <div class="p-6 rounded-xl card flex items-start space-x-4 bg-green-100 text-green-700">
                    <i data-lucide="clock" class="w-8 h-8 flex-shrink-0"></i>
                    <div>
                        <h3 class="font-semibold text-xl mb-1">Stok Real-time</h3>
                        <p class="text-sm opacity-90">Stok Kostum selalu akurat.</p>
                    </div>
                </div>
                <div class="p-6 rounded-xl card flex items-start space-x-4 bg-blue-100 text-blue-700">
                    <i data-lucide="truck" class="w-8 h-8 flex-shrink-0"></i>
                    <div>
                        <h3 class="font-semibold text-xl mb-1">Resi Antar-Jemput</h3>
                        <p class="text-sm opacity-90">Layanan antar-jemput kostum.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="catalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-gray-50 rounded-xl">
            <h2 class="text-4xl font-extrabold serif text-dark mb-2 text-center">Katalog Kostum Tari</h2>
            <p class="text-lg text-gray-600 mb-10 text-center">Lihat koleksi kami. Detail pemesanan hanya setelah login.
            </p>

            <div class="flex flex-col lg:flex-row gap-8">

                <div class="w-full lg:w-72 flex-shrink-0 bg-white p-6 rounded-xl card h-fit">
                    <h3 class="text-lg font-semibold border-b pb-2 mb-4 text-primary">Filter Kostum</h3>
                    <div class="space-y-4 text-sm">
                        <div>
                            <h4 class="font-medium mb-2">Jenis Tari</h4>
                            <div class="flex items-center mb-1">
                                <input type="checkbox" id="filter-bali" class="rounded text-primary focus:ring-primary">
                                <label for="filter-bali" class="ml-2 text-gray-700">Tari Bali</label>
                            </div>
                            <div class="flex items-center mb-1">
                                <input type="checkbox" id="filter-jawa" class="rounded text-primary focus:ring-primary">
                                <label for="filter-jawa" class="ml-2 text-gray-700">Tari Jawa</label>
                            </div>
                            <div class="flex items-center mb-1">
                                <input type="checkbox" id="filter-sunda"
                                    class="rounded text-primary focus:ring-primary">
                                <label for="filter-sunda" class="ml-2 text-gray-700">Tari Sunda</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        @forelse($kostums as $item)
                            <div
                                class="bg-white rounded-xl card overflow-hidden transform hover:scale-[1.02] transition-transform duration-300 cursor-pointer group">

                                <div class="h-60 w-full overflow-hidden bg-gray-100 relative">
                                    @if ($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-200">
                                            <i data-lucide="image-off" class="w-10 h-10"></i>
                                        </div>
                                    @endif

                                    <div
                                        class="absolute top-2 left-2 bg-white/90 px-2 py-1 rounded text-xs font-bold text-dark shadow-sm">
                                        {{ $item->kategori }}
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h3 class="font-semibold text-lg truncate text-dark">{{ $item->nama }}</h3>
                                    <p class="text-primary font-bold mt-1">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }} <span
                                            class="text-sm text-gray-500 font-normal">/ Hari</span>
                                    </p>

                                    <a href="{{ route('kostum.detail', $item->id) }}"
                                        class="block w-full text-center mt-3 px-4 py-2 bg-primary text-white rounded-lg text-sm font-bold hover:bg-dark transition-colors shadow-md">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-10 text-gray-500">
                                <i data-lucide="package-open" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                                <p>Belum ada kostum yang tersedia saat ini.</p>
                            </div>
                        @endforelse

                    </div>

                    <div class="text-center mt-10">
                        <a href="{{ route('katalog') }}"
                            class="px-6 py-3 border border-dark text-dark font-semibold rounded-lg hover:bg-gray-200 transition-colors inline-block">
                            Lihat Lebih Banyak
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="detail" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-4xl font-extrabold serif text-dark mb-6 text-center">Detail Kostum</h2>
            <p class="text-center text-lg text-gray-600 mb-10">Silakan Login untuk pemesanan.</p>
            <div
                class="bg-white p-8 rounded-xl card flex flex-col lg:flex-row gap-10 max-w-5xl mx-auto shadow-lg border border-gray-100">
                <div class="w-full lg:w-1/2">
                    <img src="{{ asset('images/tarijaipong.jpg') }}" alt="Detail"
                        class="w-full rounded-xl shadow-md border border-gray-100 mb-4">
                </div>
                <div class="w-full lg:w-1/2 space-y-6">
                    <h3 class="text-3xl font-extrabold serif text-dark">Kostum Tari Jaipong</h3>
                    <p class="text-gray-600 leading-relaxed">Kostum feminim elegan yang terinspirasi dari tari sunda.
                        Koleksi terbatas.</p>
                    <div class="p-4 bg-yellow-100 text-yellow-800 rounded-lg flex items-center space-x-2">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                        <p class="font-semibold">Stok & Ukuran disembunyikan.</p>
                    </div>
                    <div class="border-t pt-4 space-y-3">
                        <h4 class="text-2xl font-bold text-primary">Rp 150.000 / Hari</h4>
                    </div>
                    <div class="pt-4">
                        <button
                            class="px-6 py-3 bg-dark text-white font-semibold rounded-lg hover:bg-primary transition-colors w-full"
                            onclick="window.location.href='{{ route('login') }}'">
                            Login untuk Booking
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-gray-50 rounded-xl">
            <h2 class="text-4xl font-extrabold serif text-dark mb-6 text-center">Tentang Kami: EFECostume</h2>
            <p class="text-center text-lg text-gray-600 mb-10">Kami berdedikasi untuk melestarikan dan menyediakan
                kostum tari tradisional berkualitas tinggi.</p>
            <div class="bg-white p-8 rounded-xl card space-y-6">
                <h3 class="text-2xl font-semibold border-b pb-3 text-primary">Visi & Misi</h3>
                <p>Visi kami adalah menjadi platform penyewaan kostum tari terkemuka di Indonesia, mendukung setiap
                    penari untuk tampil memukau tanpa batas. Misi kami meliputi menjaga kualitas dan keaslian setiap
                    kostum.</p>
                <h3 class="text-2xl font-semibold border-b pb-3 text-primary">Koleksi Kami</h3>
                <p>Kami memiliki koleksi lengkap dari berbagai daerah, termasuk Jawa, Bali, Sunda, dan Sumatera. Setiap
                    kostum diperiksa secara berkala untuk memastikan kebersihan dan kondisi optimal.</p>
                <div class="mt-8 border-t pt-6">
                    <h3 class="text-2xl font-semibold mb-4 text-primary">Apa Kata Mereka?</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white p-4 rounded-xl card space-y-2 border-l-4 border-primary">
                            <div class="text-yellow-500 flex"><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i></div>
                            <p class="italic text-sm">"Kostumnya sangat terawat dan mudah disewa!"</p><span
                                class="font-semibold text-xs">Agnes P.</span>
                        </div>
                        <div class="bg-white p-4 rounded-xl card space-y-2 border-l-4 border-primary">
                            <div class="text-yellow-500 flex"><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i><i data-lucide="star"
                                    class="w-4 h-4 fill-yellow-500"></i></div>
                            <p class="italic text-sm">"Pilihan warna dan jenis tari sangat lengkap."</p><span
                                class="font-semibold text-xs">Bima S.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-gray-50 rounded-xl">
            <h2 class="text-4xl font-extrabold serif text-dark mb-6 text-center">Hubungi Kami</h2>
            <p class="text-center text-lg text-gray-600 mb-10">Kami siap membantu pertanyaan seputar penyewaan dan
                layanan kami.</p>
            <div class="bg-white p-8 rounded-xl card space-y-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-semibold border-b pb-3 text-primary mb-4">Informasi Kontak</h3>
                    <div class="space-y-4 text-gray-700">
                        <p class="flex items-center space-x-2"><i data-lucide="mail"
                                class="w-5 h-5 text-dark"></i><span>Email: support@efecostume.com</span></p>
                        <p class="flex items-center space-x-2"><i data-lucide="phone"
                                class="w-5 h-5 text-dark"></i><span>Telepon: (021) 1234 5678</span></p>
                        <p class="flex items-center space-x-2"><i data-lucide="map-pin"
                                class="w-5 h-5 text-dark"></i><span>Alamat: Jl. Cipadung No. 10, Kota Bandung</span>
                        </p>
                    </div>
                </div>
        </section>

    </main>

    <footer id="main-footer" class="bg-dark text-white py-10 text-center">
        <p>&copy; 2024 EFECostume. All rights reserved.</p>
    </footer>

    <script>
        // Init Icons
        lucide.createIcons();

        // Navigasi Scroll
        function handleNav(id) {
            document.getElementById(id).scrollIntoView({
                behavior: 'smooth'
            });
        }

        console.log("Halaman siap.");
    </script>
</body>

</html>
