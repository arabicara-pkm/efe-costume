<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - EFE Costume</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md border-t-4 border-[#be123c]">

        <div class="flex flex-col items-center justify-center space-y-2 mb-6">
            <div class="flex items-center space-x-2">
                <span class="text-2xl font-extrabold text-[#1f2937] font-serif">EFECostume</span>
                <i data-lucide="crown" class="w-6 h-6 text-[#be123c]"></i>
            </div>
            <p class="text-gray-500 text-sm">Masuk untuk mulai menyewa</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-3 rounded-lg mb-4 text-sm border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 text-green-700 p-3 rounded-lg mb-4 text-sm border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1 text-sm">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <input type="email" name="email" required
                        class="w-full pl-10 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#be123c] focus:border-[#be123c] focus:outline-none transition-all"
                        placeholder="nama@email.com">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1 text-sm">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <input type="password" name="password" required
                        class="w-full pl-10 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#be123c] focus:border-[#be123c] focus:outline-none transition-all"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-[#be123c] text-white font-bold py-3 rounded-lg hover:bg-[#9f1239] transition duration-300 shadow-md">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-6 text-center border-t pt-4">
            <p class="text-sm text-gray-600">Belum punya akun? <a href="{{ route('register') }}"
                    class="text-[#be123c] font-bold hover:underline">Daftar disini</a></p>
            <div class="mt-4">
                <a href="{{ route('home') }}"
                    class="text-xs text-gray-400 hover:text-gray-600 flex items-center justify-center gap-1">
                    <i data-lucide="arrow-left" class="w-3 h-3"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
