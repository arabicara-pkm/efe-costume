<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member - EFECostume</title>

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

        /* Modal Animation */
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
                <a href="{{ route('dashboard') }}" class="text-primary font-bold">Dashboard</a>
                <a href="{{ route('katalog') }}" class="hover:text-primary transition-colors">Katalog</a>
                <a href="{{ route('order.index') }}" class="hover:text-primary transition-colors">Pesanan Saya</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-primary transition-colors">Profil</a>
            </div>

            <div class="flex items-center space-x-6">
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
            </div>
        </nav>
    </header>

    <main class="flex-1 py-10">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-bold serif text-dark mb-2">
                Selamat Datang, <span class="text-primary">{{ Auth::user()->name }}</span>!
            </h1>
            <p class="text-gray-500 mb-8">Ringkasan aktivitas akun Anda.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                    <div class="p-3 bg-yellow-50 rounded-xl text-yellow-700"><i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Sedang Disewa</p>
                        {{-- Data statis sementara, nanti bisa diganti variabel dari Controller --}}
                        <p class="text-2xl font-bold text-dark">0</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                    <div class="p-3 bg-red-50 rounded-xl text-red-700"><i data-lucide="credit-card" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Menunggu Bayar</p>
                        <p class="text-2xl font-bold text-dark">0</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                    <div class="p-3 bg-green-50 rounded-xl text-green-700"><i data-lucide="check-circle"
                            class="w-6 h-6"></i></div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Histori</p>
                        <p class="text-2xl font-bold text-dark">0</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 space-y-6">
                    <h2 class="text-xl font-bold border-b pb-4 text-dark flex items-center gap-2">
                        <i data-lucide="gift" class="w-5 h-5 text-primary"></i> Promo Khusus Member
                    </h2>
                    <div class="p-5 bg-pink-50 border border-pink-100 rounded-xl">
                        <p class="font-bold text-primary text-lg">DISKON 10% Spesial!</p>
                        <p class="text-sm text-gray-600 mt-1">Gunakan kode: <span
                                class="font-mono bg-white px-2 py-1 rounded border border-pink-200 font-bold text-dark">EFE10</span>
                            saat checkout.</p>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 space-y-6">
                    <div class="flex justify-between items-center border-b pb-4">
                        <h2 class="text-xl font-bold text-dark">Saran Untuk Anda</h2>
                        <a href="{{ route('katalog') }}" class="text-sm text-primary hover:underline">Lihat Semua</a>
                    </div>

                    <div class="flex gap-4">
                        {{-- Route detail kostum bisa disesuaikan ID-nya nanti --}}
                        <a href="{{ route('kostum.detail', ['id' => 1]) }}"
                            class="w-full bg-white rounded-xl border border-gray-200 p-4 flex items-center gap-4 hover:shadow-md transition-shadow cursor-pointer">
                            <div class="h-16 w-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ asset('images/taripendet.jpg') }}"
                                    onerror="this.src='{{ asset('images/tarijaipong.jpg') }}'"
                                    class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-bold text-dark">Kostum Pendet</h3>
                                <p class="text-primary text-sm font-bold">Rp 175.000</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
                <p class="text-gray-500 mb-6 text-sm leading-relaxed">Apakah Anda yakin ingin keluar dari akun Member?
                </p>
                <div class="flex gap-3">
                    <button onclick="closeLogoutModal()"
                        class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">Batal</button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="flex-1">
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
        // Init Icons
        lucide.createIcons();

        // Modal Functions
        function showLogoutModal() {
            document.getElementById('logout-modal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logout-modal').classList.add('hidden');
        }
    </script>
</body>

</html>
