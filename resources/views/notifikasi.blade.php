<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - EFECostume</title>

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
                <a href="{{ route('cart.index') }}" class="relative text-dark hover:text-primary transition-colors">
                    <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                    {{-- <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">1</span> --}}
                </a>

                <a href="{{ route('notifikasi.index') }}" class="text-primary font-bold transition-colors relative">
                    <i data-lucide="bell" class="w-6 h-6"></i>
                    @if ($notifications->whereNull('read_at')->count() > 0)
                        <span
                            class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-600 rounded-full border-2 border-white"></span>
                    @endif
                </a>

                <button onclick="showLogoutModal()"
                    class="bg-[#9F1239] hover:bg-[#881337] text-white px-6 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm">
                    Logout
                </button>
            </div>
        </nav>
    </header>

    <main class="flex-1 py-10">
        <section class="max-w-3xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold serif text-dark">Notifikasi Anda</h1>
                @if ($notifications->count() > 0)
                    <button class="text-sm text-primary hover:underline">Tandai semua dibaca</button>
                @endif
            </div>

            <div class="space-y-4">

                @forelse($notifications as $notif)
                    @php
                        // Logika Tipe & Warna Notifikasi
                        $type = $notif->data['type'] ?? 'info';

                        $icon = 'info';
                        $colorClass = 'text-blue-600 border-blue-600 bg-blue-50';
                        $iconBg = 'bg-blue-100';

                        if ($type == 'promo') {
                            $icon = 'tag';
                            $colorClass = 'text-green-600 border-green-500 bg-green-50';
                            $iconBg = 'bg-green-100';
                        } elseif ($type == 'warning') {
                            $icon = 'alert-triangle';
                            $colorClass = 'text-red-600 border-red-500 bg-red-50';
                            $iconBg = 'bg-red-100';
                        } elseif ($type == 'success') {
                            $icon = 'check-circle';
                            $colorClass = 'text-teal-600 border-teal-500 bg-teal-50';
                            $iconBg = 'bg-teal-100';
                        }

                        // Cek apakah belum dibaca
                        $unreadClass = $notif->read_at == null ? 'border-l-4' : 'border border-gray-100 opacity-75';
                        $borderColor = $notif->read_at == null ? $colorClass : 'bg-white';
                    @endphp

                    <div class="p-5 rounded-2xl shadow-sm flex items-start space-x-4 hover:shadow-md transition-all duration-200 {{ $unreadClass }} {{ $notif->read_at == null ? '' : 'bg-white' }}"
                        style="{{ $notif->read_at == null ? '' : 'border-left-width: 0;' }}">

                        <div class="flex-shrink-0 mt-1">
                            <div class="p-2 rounded-full {{ $iconBg }}">
                                <i data-lucide="{{ $icon }}"
                                    class="w-5 h-5 {{ str_replace('bg-', 'text-', $colorClass) }}"></i>
                            </div>
                        </div>

                        <div class="flex-1">
                            <p class="text-dark font-medium text-sm leading-relaxed">
                                {{ $notif->data['message'] ?? 'Ada notifikasi baru untuk Anda.' }}
                            </p>
                            <p class="text-xs text-gray-400 mt-2 flex items-center">
                                <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </div>

                        @if ($notif->read_at == null)
                            <div class="flex-shrink-0 self-center">
                                <span class="w-2.5 h-2.5 bg-red-500 rounded-full block ring-2 ring-white shadow"></span>
                            </div>
                        @endif
                    </div>

                @empty
                    <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-200">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="bell-off" class="w-8 h-8 text-gray-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-700">Tidak ada notifikasi</h3>
                        <p class="text-gray-400 text-sm mt-1">Kami akan memberi tahu Anda jika ada pembaruan.</p>
                        <a href="{{ route('katalog') }}"
                            class="inline-block mt-4 text-primary font-bold text-sm hover:underline">
                            Mulai Belanja
                        </a>
                    </div>
                @endforelse

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

        // Logika Modal Logout
        function showLogoutModal() {
            document.getElementById('logout-modal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logout-modal').classList.add('hidden');
        }
    </script>
</body>

</html>
