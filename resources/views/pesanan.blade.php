<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - EFECostume</title>

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
                <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
                <a href="{{ route('katalog') }}" class="hover:text-primary transition-colors">Katalog</a>
                <a href="{{ route('order.index') }}" class="text-primary font-bold">Pesanan Saya</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-primary transition-colors">Profil</a>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}" class="relative text-dark hover:text-primary transition-colors">
                    <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                    <span
                        class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">!</span>
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
            <h1 class="text-3xl font-bold serif text-dark mb-8">Status Pesanan</h1>

            @if (session('success'))
                <div
                    class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="space-y-6">

                @if ($orders->isEmpty())
                    <div class="bg-white p-10 rounded-2xl border border-dashed border-gray-300 text-center">
                        <div class="inline-block p-4 bg-gray-50 rounded-full mb-3">
                            <i data-lucide="clipboard-list" class="w-10 h-10 text-gray-300"></i>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada riwayat pesanan.</p>
                        <a href="{{ route('katalog') }}"
                            class="text-primary font-bold hover:underline mt-2 inline-block">Mulai Sewa Sekarang</a>
                    </div>
                @else
                    @foreach ($orders as $order)
                        {{-- Logika Warna Badge Status --}}
                        @php
                            $badgeClass = 'bg-gray-100 text-gray-700 border-gray-200';
                            $statusLabel = 'Menunggu';

                            if ($order->status == 'menunggu_bayar') {
                                $badgeClass = 'bg-red-100 text-red-700 border-red-200';
                                $statusLabel = 'Menunggu Bayar';
                            } elseif ($order->status == 'diproses') {
                                $badgeClass = 'bg-yellow-100 text-yellow-700 border-yellow-200';
                                $statusLabel = 'Diproses';
                            } elseif ($order->status == 'selesai' || $order->status == 'kembali') {
                                $badgeClass = 'bg-green-100 text-green-700 border-green-200';
                                $statusLabel = 'Selesai';
                            }
                        @endphp

                        <div
                            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center hover:shadow-md transition-shadow group">

                            <div class="flex items-center space-x-6 w-full md:w-auto">
                                <div class="h-20 w-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 relative">
                                    <img src="{{ asset($order->kostum->gambar) }}"
                                        onerror="this.src='https://placehold.co/150'"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-mono mb-1">ORDER ID:
                                        #{{ $order->invoice_number }}</p>
                                    <h3 class="text-lg font-bold text-dark">{{ $order->kostum->nama }}</h3>
                                    <p class="text-primary font-semibold">
                                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        <span class="text-gray-400 font-normal text-xs">/ {{ $order->jumlah_hari }}
                                            Hari</span>
                                    </p>
                                </div>
                            </div>

                            <div
                                class="mt-4 md:mt-0 text-right w-full md:w-auto flex flex-row md:flex-col justify-between items-center md:items-end">
                                <span class="px-4 py-1.5 text-xs font-bold rounded-full border {{ $badgeClass }}">
                                    {{ $statusLabel }}
                                </span>

                                <div class="mt-0 md:mt-2 text-right">
                                    <p class="text-xs text-gray-400 mb-2">Tanggal:
                                        {{ $order->created_at->format('d M Y') }}</p>

                                    @if ($order->status == 'menunggu_bayar')
                                        <button
                                            onclick="handlePayNow('{{ $order->invoice_number }}', '{{ $order->total_harga }}')"
                                            class="px-4 py-2 bg-[#9F1239] text-white text-xs font-bold rounded-lg hover:bg-[#881337] transition-colors shadow-md transform active:scale-95">
                                            Bayar Sekarang
                                        </button>
                                    @else
                                        <a href="{{ route('kostum.detail', $order->kostum_id) }}"
                                            class="text-sm font-bold text-primary hover:underline">
                                            Lihat Kostum
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif

            </div>
        </section>
    </main>

    <div id="payment-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closePaymentModal()"></div>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div
                class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md relative z-10 modal-enter border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-dark tracking-tight">Metode Pembayaran</h3>
                    <button onclick="closePaymentModal()" class="text-gray-400 hover:text-dark transition-colors"><i
                            data-lucide="x" class="w-6 h-6"></i></button>
                </div>

                <input type="hidden" id="pay_invoice_id">

                <div class="space-y-3">
                    <label
                        class="flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:border-primary transition-all group">
                        <input type="radio" name="pay_method" class="w-5 h-5 accent-primary" checked>
                        <div class="ml-4 flex-1">
                            <p class="font-bold text-dark group-hover:text-primary">QRIS / E-Wallet</p>
                            <p class="text-xs text-gray-400">OVO, GoPay, Dana, ShopeePay</p>
                        </div>
                        <i data-lucide="qr-code" class="text-gray-300"></i>
                    </label>
                    <label
                        class="flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:border-primary transition-all group">
                        <input type="radio" name="pay_method" class="w-5 h-5 accent-primary">
                        <div class="ml-4 flex-1">
                            <p class="font-bold text-dark group-hover:text-primary">Virtual Account</p>
                            <p class="text-xs text-gray-400">BCA, Mandiri, BNI, BRI</p>
                        </div>
                        <i data-lucide="credit-card" class="text-gray-300"></i>
                    </label>
                </div>
                <div class="mt-8">
                    <button onclick="processToInvoice()"
                        class="w-full py-4 bg-[#9F1239] text-white rounded-2xl font-bold hover:bg-[#881337] shadow-lg transition-all">
                        Lanjut Pembayaran
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
                <p id="invoice_text_id" class="text-xs text-gray-400 mb-4">INV-XXX</p>

                <div class="bg-gray-50 p-4 rounded-3xl mb-6 inline-block border-2 border-dashed border-gray-200">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=EFECostumePayment"
                        alt="QRIS" class="w-48 h-48 mx-auto">
                </div>

                <button onclick="handleFinishPayment()"
                    class="w-full py-3.5 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition-all shadow-md active:scale-95">
                    Konfirmasi Selesai Bayar
                </button>
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
                <p class="text-gray-500 mb-6 text-sm leading-relaxed">Apakah Anda yakin ingin keluar dari akun Member?
                </p>
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

        // --- Fungsi Modal Pembayaran ---
        function handlePayNow(invoiceNumber, price) {
            // Set ID Invoice agar user tahu mana yang dibayar
            document.getElementById('pay_invoice_id').value = invoiceNumber;
            document.getElementById('invoice_text_id').innerText = '#' + invoiceNumber;

            // Tampilkan Modal Pilihan
            document.getElementById('payment-modal').classList.remove('hidden');
        }

        function closePaymentModal() {
            document.getElementById('payment-modal').classList.add('hidden');
        }

        function processToInvoice() {
            closePaymentModal();
            document.getElementById('invoice-modal').classList.remove('hidden');
        }

        function handleFinishPayment() {
            // Di sini nanti bisa tambahkan AJAX untuk update status order jadi 'diproses'
            // Untuk sekarang, kita reload saja agar terlihat selesai secara visual (dummy flow)
            alert("Pembayaran terkonfirmasi! Status pesanan akan segera diperbarui.");
            location.reload();
        }

        // --- Fungsi Modal Logout ---
        function showLogoutModal() {
            document.getElementById('logout-modal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logout-modal').classList.add('hidden');
        }
    </script>
</body>

</html>
