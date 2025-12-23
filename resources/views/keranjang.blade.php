<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - EFECostume</title>

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

    <header class="bg-white sticky top-0 z-40 shadow-sm border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2 cursor-pointer" onclick="window.location.href='{{ route('home') }}'">
                <span class="text-2xl font-bold text-dark serif tracking-wide">EFECostume</span>
                <i data-lucide="crown" class="w-6 h-6 text-primary"></i>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-[15px] font-medium text-gray-600">
                <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
                <a href="{{ route('katalog') }}" class="hover:text-primary transition-colors">Katalog</a>
                <a href="{{ route('order.index') }}" class="hover:text-primary transition-colors">Pesanan Saya</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-primary transition-colors">Profil</a>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}" class="relative text-primary font-bold transition-colors">
                    <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                    <span
                        class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">
                        {{ count($carts) }}
                    </span>
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
        <section class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold serif text-dark mb-8">Keranjang Belanja</h1>

            @if (session('success'))
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    @if ($carts->isEmpty())
                        <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-100 text-center">
                            <i data-lucide="shopping-cart" class="w-16 h-16 text-gray-200 mx-auto mb-4"></i>
                            <h3 class="text-lg font-bold text-gray-600">Keranjang Anda Kosong</h3>
                            <p class="text-gray-400 mb-6">Belum ada kostum yang ditambahkan.</p>
                            <a href="{{ route('katalog') }}"
                                class="px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-red-800 transition">
                                Cari Kostum Dulu
                            </a>
                        </div>
                    @else
                        @foreach ($carts as $item)
                            <div
                                class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-6 items-center group hover:border-primary/30 transition-all">

                                <div class="h-28 w-28 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ asset($item->kostum->gambar) }}"
                                        onerror="this.src='https://placehold.co/150'"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>

                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-bold text-xl text-dark">{{ $item->kostum->nama }}</h3>
                                            <p class="text-sm text-gray-500 mt-1">
                                                Ukuran: <b>{{ $item->ukuran }}</b> •
                                                Durasi: <b>{{ $item->jumlah_hari }} Hari</b>
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ \Carbon\Carbon::parse($item->tanggal_sewa)->format('d M') }} -
                                                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M') }}
                                            </p>
                                        </div>

                                        <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-gray-400 hover:text-red-500 transition-colors p-2 hover:bg-red-50 rounded-lg">
                                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="mt-4 flex justify-between items-end">
                                        <p class="text-primary font-bold text-lg">
                                            Rp
                                            {{ number_format($item->kostum->harga * $item->jumlah_hari, 0, ',', '.') }}
                                            <span class="text-xs text-gray-400 font-normal block sm:inline">(@ Rp
                                                {{ number_format($item->kostum->harga) }}/hari)</span>
                                        </p>

                                        <div
                                            class="flex items-center border border-gray-200 rounded-xl p-1 bg-gray-50 text-xs">
                                            <span class="px-3 py-1 font-bold text-gray-600">{{ $item->jumlah_hari }}
                                                Hari</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                @if (!$carts->isEmpty())
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-fit sticky top-24">
                        <h2 class="text-lg font-bold border-b pb-4 mb-4">Ringkasan Pesanan</h2>
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Subtotal Sewa</span>
                                <span class="font-semibold text-dark">Rp
                                    {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Biaya Layanan</span>
                                <span class="font-semibold text-dark">Rp 5.000</span>
                            </div>
                            <div class="flex justify-between text-green-600 hidden">
                                <span>Diskon Member</span>
                                <span class="font-semibold">- Rp 0</span>
                            </div>
                        </div>

                        <div class="border-t my-4 pt-4 flex justify-between items-center">
                            <span class="font-bold text-dark text-lg">Total Bayar</span>
                            <span class="font-bold text-2xl text-primary">Rp
                                {{ number_format($subtotal + 5000, 0, ',', '.') }}</span>
                        </div>

                        <button onclick="showPaymentModal()"
                            class="w-full py-4 mt-4 bg-[#9F1239] text-white rounded-xl font-bold hover:bg-[#881337] transition-all shadow-lg transform hover:-translate-y-1 active:scale-95">
                            Bayar Sekarang
                        </button>

                        <div
                            class="mt-4 flex items-center justify-center gap-2 text-[10px] text-gray-400 tracking-widest uppercase">
                            <i data-lucide="shield-check" class="w-3 h-3"></i> Transaksi Aman & Terenkripsi
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <div id="payment-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closePaymentModal()"></div>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md relative z-10 modal-enter">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-dark tracking-tight">Metode Pembayaran</h3>
                    <button onclick="closePaymentModal()" class="text-gray-400 hover:text-dark transition-colors"><i
                            data-lucide="x" class="w-6 h-6"></i></button>
                </div>

                <div class="space-y-3">
                    <label
                        class="flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:border-primary group transition-all">
                        <input type="radio" name="pay_method_visual" class="w-5 h-5 accent-primary" checked>
                        <div class="ml-4 flex-1">
                            <p class="font-bold text-dark group-hover:text-primary">QRIS / E-Wallet</p>
                            <p class="text-xs text-gray-400">OVO, GoPay, Dana, ShopeePay</p>
                        </div>
                        <i data-lucide="qr-code" class="text-gray-300"></i>
                    </label>
                    <label
                        class="flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:border-primary group transition-all">
                        <input type="radio" name="pay_method_visual" class="w-5 h-5 accent-primary">
                        <div class="ml-4 flex-1">
                            <p class="font-bold text-dark group-hover:text-primary">Virtual Account</p>
                            <p class="text-xs text-gray-400">BCA, Mandiri, BNI, BRI</p>
                        </div>
                        <i data-lucide="credit-card" class="text-gray-300"></i>
                    </label>
                </div>

                <div class="mt-8">
                    <button onclick="handleProcessPayment()"
                        class="w-full py-4 bg-[#9F1239] text-white rounded-2xl font-bold hover:bg-[#881337] transition-all active:scale-95 shadow-md">
                        Lanjut Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="invoice-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div
                class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm relative z-10 modal-enter text-center border border-gray-100">
                <div class="mb-4">
                    <span
                        class="px-3 py-1 bg-yellow-100 text-yellow-700 text-[10px] font-bold rounded-full uppercase tracking-widest">Menunggu
                        Pembayaran</span>
                </div>
                <h3 class="text-lg font-bold text-dark mb-1">Scan QRIS Untuk Bayar</h3>

                <div class="bg-gray-50 p-4 rounded-3xl mb-6 inline-block border-2 border-dashed border-gray-200">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=EFECostumeOrder"
                        alt="QRIS" class="w-48 h-48 mx-auto">
                </div>

                <div class="text-sm font-medium text-gray-600 mb-8">
                    Total: <span class="text-primary font-bold text-2xl tracking-tighter">Rp
                        {{ number_format($subtotal + 5000, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="QRIS">

                    <button type="submit"
                        class="w-full py-3.5 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition-all shadow-md active:scale-95">
                        Konfirmasi Selesai Bayar
                    </button>
                </form>

                <button onclick="closeAllModals()" class="mt-4 text-xs text-gray-400 hover:text-gray-600">Batal /
                    Bayar Nanti</button>
            </div>
        </div>
    </div>

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
                <p class="text-gray-500 mb-6 text-sm leading-relaxed">Apakah Anda yakin ingin keluar?</p>
                <div class="flex gap-3">
                    <button onclick="closeLogoutModal()"
                        class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">Batal</button>

                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full py-2.5 bg-[#9F1239] text-white rounded-xl font-medium hover:bg-[#881337] transition-colors shadow-lg">Ya,
                            Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // --- Logika Modal Pembayaran ---
        function showPaymentModal() {
            document.getElementById('payment-modal').classList.remove('hidden');
        }

        function handleProcessPayment() {
            // Tutup modal pilih metode, buka modal invoice
            closePaymentModal();
            document.getElementById('invoice-modal').classList.remove('hidden');
        }

        function closePaymentModal() {
            document.getElementById('payment-modal').classList.add('hidden');
        }

        function closeAllModals() {
            document.getElementById('payment-modal').classList.add('hidden');
            document.getElementById('invoice-modal').classList.add('hidden');
        }

        // --- Logika Modal Logout ---
        function showLogoutModal() {
            document.getElementById('logout-modal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logout-modal').classList.add('hidden');
        }
    </script>
</body>

</html>
