<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - EFECostume</title>

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
                <a href="{{ route('profile.edit') }}" class="text-primary font-bold">Profil</a>
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
        <section class="max-w-4xl mx-auto px-6">
            <h1 class="text-3xl font-bold serif text-dark mb-8 text-center">Profil Saya</h1>

            @if (session('success'))
                <div
                    class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 space-y-8">

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center border-b border-gray-100 pb-6">
                        <div class="relative group cursor-pointer"
                            onclick="document.getElementById('avatar-input').click()">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                    class="rounded-full mb-3 border-4 border-pink-50 w-24 h-24 object-cover shadow-sm group-hover:opacity-90 transition">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center text-3xl font-bold border-4 border-pink-50 shadow-sm mb-3">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif

                            <div
                                class="absolute bottom-3 right-0 bg-white p-1.5 rounded-full shadow border border-gray-200 text-gray-600 group-hover:text-primary transition-colors">
                                <i data-lucide="camera" class="w-4 h-4"></i>
                            </div>

                            <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*">
                        </div>

                        <h2 class="text-2xl font-bold text-dark">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>

                        @if ($user->role == 'admin')
                            <span
                                class="mt-2 px-3 py-1 bg-gray-800 text-white text-xs font-bold rounded-full">Administrator</span>
                        @else
                            <span
                                class="mt-2 px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">Member
                                Gold</span>
                        @endif
                    </div>

                    <div class="space-y-5 mt-6">
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-3 flex items-center gap-2">
                                <i data-lucide="user" class="w-5 h-5"></i> Data Diri
                            </h3>
                            <div class="grid gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700 mb-1 block">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 mb-1 block">Nomor WhatsApp</label>
                                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                        placeholder="Contoh: 08123456789"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 mb-1 block">Alamat
                                        Pengiriman</label>
                                    <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap..."
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-6 mt-6 border-t border-gray-100">
                        <h3 class="text-lg font-semibold text-primary mb-2 flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-5 h-5"></i> Verifikasi Akun
                        </h3>
                        <div class="p-4 bg-gray-50 rounded-lg border border-dashed border-gray-300 text-center hover:bg-gray-100 transition-colors cursor-pointer"
                            onclick="document.getElementById('ktp-upload').click()">
                            <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                            <p class="text-sm font-medium text-gray-600">Upload Foto KTP / Kartu Pelajar</p>
                            <p class="text-xs text-gray-400 mt-1">(Format: JPG/PNG, Max 2MB)</p>
                            <input type="file" name="ktp_image" id="ktp-upload" class="hidden">
                        </div>
                    </div>

                    <div class="pt-8">
                        <button type="submit"
                            class="w-full p-3 bg-primary text-white font-bold rounded-xl hover:bg-[#881337] transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                            <i data-lucide="save" class="w-5 h-5"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
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
