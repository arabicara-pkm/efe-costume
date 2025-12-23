<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kostum->nama }} - Detail Produk</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .serif {
            font-family: 'Playfair Display', serif;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .text-primary {
            color: #9F1239;
        }

        .bg-primary {
            background-color: #9F1239;
        }

        .text-dark {
            color: #2D0A12;
        }

        /* Animasi Modal */
        .modal-enter {
            animation: fadeIn 0.3s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col text-dark">

    <header class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center space-x-2 cursor-pointer" onclick="window.location.href='{{ route('home') }}'">
                <span class="text-2xl font-bold text-dark serif tracking-wide">EFECostume</span>
                <i data-lucide="crown" class="w-6 h-6 text-primary"></i>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-[15px] font-medium text-gray-600">
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
                @endauth
                <a href="{{ route('katalog') }}" class="text-primary font-bold">Katalog</a>

                @auth
                    <a href="{{ route('order.index') }}" class="hover:text-primary transition-colors">Pesanan Saya</a>
                    <a href="{{ route('profile.edit') }}" class="hover:text-primary transition-colors">Profil</a>
                @endauth
            </div>

            <div class="flex items-center space-x-6">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-bold text-primary hover:underline">Masuk / Daftar</a>
                @else
                    <a href="{{ route('cart.index') }}" class="relative text-dark hover:text-primary transition-colors">
                        <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                        <span
                            class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">0</span>
                    </a>
                    <a href="{{ route('notifikasi.index') }}" class="text-dark hover:text-primary transition-colors"><i
                            data-lucide="bell" class="w-6 h-6"></i></a>
                    <button onclick="showLogoutModal()"
                        class="bg-[#9F1239] hover:bg-[#881337] text-white px-6 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm">Logout</button>
                @endguest
            </div>
        </nav>
    </header>

    <main class="flex-1 py-10">
        <section class="max-w-7xl mx-auto px-6">

            <a href="{{ route('katalog') }}"
                class="inline-flex items-center text-gray-500 hover:text-primary font-medium mb-6 transition">
                <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i> Kembali ke Katalog
            </a>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col lg:flex-row gap-10">

                <div class="w-full lg:w-1/2">
                    <div
                        class="aspect-[4/3] w-full bg-gray-100 rounded-xl overflow-hidden mb-4 shadow-md relative group">
                        <img src="{{ asset($kostum->gambar) }}"
                            onerror="this.src='https://placehold.co/600x400?text=No+Image'" alt="{{ $kostum->nama }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold shadow text-dark uppercase tracking-wide">
                            {{ $kostum->kategori }}
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 space-y-6">
                    <div>
                        <h1 class="text-4xl font-bold serif text-dark mb-2">{{ $kostum->nama }}</h1>

                        <div class="flex items-center text-yellow-500 mb-4">
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <span class="text-gray-400 text-sm ml-2">(Review Belum Tersedia)</span>
                        </div>

                        <p class="text-gray-600 leading-relaxed">{{ $kostum->deskripsi }}</p>
                    </div>

                    <div class="border-t border-gray-100 pt-6 space-y-6">
                        <div>
                            <h3 class="text-3xl font-bold text-primary">
                                Rp {{ number_format($kostum->harga, 0, ',', '.') }}
                            </h3>
                            <p class="text-sm text-green-600 font-semibold flex items-center mt-1">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i> Stok Tersedia:
                                {{ $kostum->stok }}
                            </p>
                        </div>

                        <form id="addToCartForm" action="{{ route('cart.add', $kostum->id) }}" method="POST">
                            @csrf
                            <div class="bg-gray-50 p-5 rounded-xl space-y-5 border border-gray-100">

                                <div>
                                    <label class="block font-semibold mb-2 text-sm text-dark">Tanggal Sewa:</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <span class="text-xs text-gray-500 block mb-1">Mulai</span>
                                            <input type="date" name="tanggal_sewa" required
                                                class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                                        </div>
                                        <div>
                                            <span class="text-xs text-gray-500 block mb-1">Selesai</span>
                                            <input type="date" name="tanggal_kembali" required
                                                class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-semibold mb-2 text-sm text-dark">Pilih Ukuran:</label>

                                    <input type="hidden" name="ukuran" id="selected_size_input" required>

                                    <div class="flex space-x-3" id="size-options">
                                        <button type="button" onclick="selectSize(this, 'S')"
                                            class="size-btn w-10 h-10 border border-gray-300 rounded-lg hover:border-primary bg-white transition-all text-sm font-medium">S</button>
                                        <button type="button" onclick="selectSize(this, 'M')"
                                            class="size-btn w-10 h-10 border border-gray-300 rounded-lg hover:border-primary bg-white transition-all text-sm font-medium">M</button>
                                        <button type="button" onclick="selectSize(this, 'L')"
                                            class="size-btn w-10 h-10 border border-gray-300 rounded-lg hover:border-primary bg-white transition-all text-sm font-medium">L</button>
                                        <button type="button" onclick="selectSize(this, 'XL')"
                                            class="size-btn w-10 h-10 border border-gray-300 rounded-lg hover:border-primary bg-white transition-all text-sm font-medium">XL</button>
                                    </div>
                                    <p id="size-error" class="text-red-500 text-xs mt-2 hidden flex items-center">
                                        <i data-lucide="alert-circle" class="w-3 h-3 mr-1"></i> Silakan pilih ukuran
                                        terlebih dahulu!
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                <button type="button" onclick="submitForm()"
                                    class="flex-1 px-6 py-3.5 bg-white border-2 border-primary text-primary font-bold rounded-xl hover:bg-pink-50 transition-colors flex items-center justify-center gap-2">
                                    <i data-lucide="shopping-cart" class="w-5 h-5"></i> Tambah Keranjang
                                </button>

                                <button type="button" onclick="submitForm()"
                                    class="flex-1 px-6 py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-[#881337] transition-all shadow-lg text-center">
                                    Sewa Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="logout-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeLogoutModal()">
        </div>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div
                class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-sm relative z-10 modal-enter text-center border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="log-out" class="w-8 h-8 text-red-600"></i>
                </div>
                <h3 class="text-xl font-bold text-dark mb-2">Konfirmasi Keluar</h3>
                <p class="text-gray-500 mb-6 text-sm">Apakah Anda yakin ingin keluar dari akun?</p>
                <div class="flex gap-3">
                    <button onclick="closeLogoutModal()"
                        class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">Batal</button>
                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full py-2.5 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-colors shadow-lg shadow-red-200">Ya,
                            Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        let selectedSize = null;

        // Fungsi Pilih Ukuran
        function selectSize(btn, size) {
            // Reset style semua tombol
            document.querySelectorAll('.size-btn').forEach(b => {
                b.classList.remove('bg-primary', 'text-white', 'border-primary');
                b.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
            });

            // Set style tombol aktif
            btn.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
            btn.classList.add('bg-primary', 'text-white', 'border-primary');

            // Set value ke hidden input
            selectedSize = size;
            document.getElementById('selected_size_input').value = size;

            // Sembunyikan error
            document.getElementById('size-error').classList.add('hidden');
        }

        // Fungsi Submit Form dengan Validasi
        function submitForm() {
            if (!selectedSize) {
                document.getElementById('size-error').classList.remove('hidden');
                // Scroll sedikit agar error terlihat
                document.getElementById('size-options').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                return;
            }

            // Submit form secara manual
            document.getElementById('addToCartForm').submit();
        }

        // Fungsi Modal Logout
        function showLogoutModal() {
            document.getElementById('logout-modal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logout-modal').classList.add('hidden');
        }
    </script>
</body>

</html>
