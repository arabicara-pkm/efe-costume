<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kostum - EFECostume</title>

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

        /* Animasi Modal Logout */
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

                    <a href="{{ route('notifikasi.index') }}" class="text-dark hover:text-primary transition-colors">
                        <i data-lucide="bell" class="w-6 h-6"></i>
                    </a>

                    <button onclick="showLogoutModal()"
                        class="bg-[#9F1239] hover:bg-[#881337] text-white px-6 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm">
                        Logout
                    </button>
                @endguest
            </div>
        </nav>
    </header>

    <main class="flex-1 py-10">
        <section class="max-w-7xl mx-auto px-6">

            <div class="mb-8">
                <h1 class="text-4xl font-bold serif text-dark">Katalog Kostum</h1>
                <p class="text-gray-500 mt-2">Temukan kostum terbaik untuk penampilan Anda.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">

                <div class="w-full lg:w-64 flex-shrink-0">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                        <h3 class="text-lg font-bold border-b pb-3 mb-4 text-primary font-serif">Filter Kostum</h3>

                        <form action="{{ route('katalog') }}" method="GET">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-medium text-sm text-dark mb-3">Kategori</h4>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <label class="flex items-center hover:text-primary cursor-pointer">
                                            <input type="checkbox" name="kategori[]" value="Bali"
                                                class="rounded text-primary focus:ring-primary mr-2"> Tari Bali
                                        </label>
                                        <label class="flex items-center hover:text-primary cursor-pointer">
                                            <input type="checkbox" name="kategori[]" value="Jawa"
                                                class="rounded text-primary focus:ring-primary mr-2"> Tari Jawa
                                        </label>
                                        <label class="flex items-center hover:text-primary cursor-pointer">
                                            <input type="checkbox" name="kategori[]" value="Sunda"
                                                class="rounded text-primary focus:ring-primary mr-2"> Tari Sunda
                                        </label>
                                        <label class="flex items-center hover:text-primary cursor-pointer">
                                            <input type="checkbox" name="kategori[]" value="Sumatera"
                                                class="rounded text-primary focus:ring-primary mr-2"> Tari Sumatera
                                        </label>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full py-2 bg-gray-100 text-dark font-semibold rounded-lg hover:bg-gray-200 transition">
                                    Terapkan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="flex-1">
                    @if ($kostums->isEmpty())
                        <div
                            class="flex flex-col items-center justify-center py-20 bg-white rounded-2xl border border-dashed border-gray-300">
                            <i data-lucide="package-open" class="w-16 h-16 text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">Belum ada kostum yang tersedia.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($kostums as $item)
                                <div
                                    class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col h-full">

                                    <div class="h-60 w-full bg-gray-100 relative overflow-hidden">
                                        <img src="{{ asset($item->gambar) }}"
                                            onerror="this.src='https://placehold.co/600x400?text=No+Image'"
                                            alt="{{ $item->nama }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                        <div
                                            class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold shadow-sm text-primary">
                                            Stok: {{ $item->stok }}
                                        </div>
                                    </div>

                                    <div class="p-5 flex flex-col flex-1">
                                        <div class="flex-1">
                                            <h3 class="font-bold text-lg serif text-dark line-clamp-1">
                                                {{ $item->nama }}</h3>
                                            <p class="text-sm text-gray-500 mb-3">
                                                {{ $item->deskripsi ?? 'Kostum tari tradisional berkualitas.' }}</p>
                                        </div>

                                        <div class="mt-4 pt-4 border-t border-gray-50">
                                            <p class="text-primary font-bold text-xl mb-3">
                                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                                                <span class="text-xs text-gray-400 font-normal">/hari</span>
                                            </p>
                                            <a href="{{ route('kostum.detail', $item->id) }}"
                                                class="block w-full py-2.5 border-2 border-dark text-dark text-center rounded-xl font-semibold hover:bg-dark hover:text-white transition-all duration-300">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
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
                <h3 class="text-xl font-bold text-dark mb-2 tracking-tight">Konfirmasi Keluar</h3>
                <p class="text-gray-500 mb-6 text-sm leading-relaxed">Apakah Anda yakin ingin keluar dari akun?</p>
                <div class="flex gap-3">
                    <button onclick="closeLogoutModal()"
                        class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full py-2.5 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-colors shadow-lg shadow-red-200">
                            Ya, Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

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
