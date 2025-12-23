<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EFECostume</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#9B2C2C',
                        secondary: '#F6E05E',
                        dark: '#1A202C',
                    }
                }
            }
        }
    </script>

    <style>
        .active-nav {
            background-color: #9B2C2C;
            /* Primary */
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .active-nav i {
            color: white;
        }

        .active-nav:hover {
            background-color: #7f1d1d;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-row text-dark">

    <aside
        class="w-64 bg-dark text-white flex flex-col fixed h-full transition-transform transform md:translate-x-0 -translate-x-full z-50"
        id="sidebar">
        <div class="p-6 flex items-center space-x-3 border-b border-gray-700">
            <i data-lucide="crown" class="w-8 h-8 text-secondary"></i>
            <span class="text-2xl font-extrabold serif tracking-wide">Admin Panel</span>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Navigasi Utama</p>

            <a href="#" onclick="adminNavigate('admin-dashboard', this)"
                class="admin-nav-item flex items-center p-3 rounded-lg active-nav transition-colors">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 text-gray-400"></i>
                <span>Dashboard Utama</span>
            </a>

            <a href="{{ route('admin.kostum.index') }}"
                class="flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-300 transition-colors">
                <i data-lucide="boxes" class="w-5 h-5 mr-3 text-gray-400"></i>
                <span>Kelola Kostum (CRUD)</span>
            </a>

            <a href="#" onclick="adminNavigate('admin-kategori', this)"
                class="admin-nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-300 transition-colors">
                <i data-lucide="bookmark" class="w-5 h-5 mr-3 text-gray-400"></i>
                <span>Kelola Kategori</span>
            </a>

            <a href="#" onclick="adminNavigate('admin-user', this)"
                class="admin-nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-300 transition-colors">
                <i data-lucide="users" class="w-5 h-5 mr-3 text-gray-400"></i>
                <span>Kelola User</span>
            </a>

            <a href="#" onclick="adminNavigate('admin-transaksi', this)"
                class="admin-nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-300 transition-colors">
                <i data-lucide="shopping-bag" class="w-5 h-5 mr-3 text-gray-400"></i>
                <span>Kelola Transaksi</span>
            </a>

            <a href="#" onclick="adminNavigate('admin-denda', this)"
                class="admin-nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-300 transition-colors">
                <i data-lucide="rotate-ccw" class="w-5 h-5 mr-3 text-gray-400"></i>
                <span>Denda & Pengembalian</span>
            </a>

            <a href="#" onclick="adminNavigate('admin-laporan', this)"
                class="admin-nav-item flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-300 transition-colors">
                <i data-lucide="bar-chart-2" class="w-5 h-5 mr-3 text-gray-400"></i>
                <span>Laporan Keuangan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center p-3 bg-red-700 rounded-lg hover:bg-red-800 transition shadow-lg text-white">
                    <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                    <span>Logout Admin</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 p-4 md:p-8 transition-all">

        <button class="md:hidden p-2 rounded-lg bg-white shadow-md mb-6" onclick="toggleSidebar()">
            <i data-lucide="menu" class="w-6 h-6 text-gray-700"></i>
        </button>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 id="admin-title" class="text-3xl font-bold text-dark serif">Dashboard Admin</h1>

            <div class="flex items-center space-x-3 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-green-600">● Administrator</span>
                </div>
            </div>
        </div>

        <div id="admin-content-detail" class="space-y-8">
        </div>

    </main>

    <script>
        // Data Dummy untuk Simulasi (Diambil dari script HTML Anda)
        const dummyKostumList = [{
                name: 'Kostum Tari Jaipong',
                price: 150000
            },
            {
                name: 'Kostum Tari Kecak',
                price: 120000
            },
            {
                name: 'Kostum Tari Piring',
                price: 140000
            },
            {
                name: 'Kostum Tari Merak',
                price: 185000
            },
            {
                name: 'Kostum Tari Pendet',
                price: 165000
            },
        ];

        // --- NAVIGASI ADMIN ---
        function adminNavigate(page, element) {
            const adminTitle = document.getElementById("admin-title");
            const adminContent = document.getElementById("admin-content-detail");

            // Update Active State di Sidebar
            if (element) {
                document.querySelectorAll(".admin-nav-item").forEach((el) => {
                    el.classList.remove("active-nav");
                    el.classList.add("hover:bg-gray-800", "text-gray-300"); // Reset style

                    // Reset icon color
                    const icon = el.querySelector('i');
                    if (icon) icon.classList.add('text-gray-400');
                });

                element.classList.add("active-nav");
                element.classList.remove("hover:bg-gray-800", "text-gray-300");
                const activeIcon = element.querySelector('i');
                if (activeIcon) activeIcon.classList.remove('text-gray-400');
            }

            // Switch Content
            switch (page) {
                case "admin-dashboard":
                    adminTitle.textContent = "Dashboard Overview";
                    adminContent.innerHTML = renderAdminDashboardBody();
                    break;
                case "admin-kostum":
                    adminTitle.textContent = "Kelola Kostum (CRUD)";
                    adminContent.innerHTML = renderAdminKostumBody();
                    break;
                case "admin-kategori":
                    adminTitle.textContent = "Kelola Kategori Tari";
                    adminContent.innerHTML = renderSimpleContent("Daftar Kategori",
                        "Simulasi: Tabel kategori tari (Bali, Jawa, Sunda, dll).");
                    break;
                case "admin-user":
                    adminTitle.textContent = "Kelola User";
                    adminContent.innerHTML = renderSimpleContent("Daftar Pengguna",
                        "Simulasi: Tabel manajemen user (Admin & Member).");
                    break;
                case "admin-transaksi":
                    adminTitle.textContent = "Kelola Transaksi";
                    adminContent.innerHTML = renderAdminTransaksiBody();
                    break;
                case "admin-denda":
                    adminTitle.textContent = "Pengembalian & Denda";
                    adminContent.innerHTML = renderSimpleContent("Denda Keterlambatan",
                        "Simulasi: Form hitung denda & konfirmasi pengembalian.");
                    break;
                case "admin-laporan":
                    adminTitle.textContent = "Laporan Keuangan";
                    adminContent.innerHTML = renderSimpleContent("Laporan Bulanan",
                        "Simulasi: Grafik pendapatan & export PDF/Excel.");
                    break;
                default:
                    adminTitle.textContent = "Dashboard Overview";
                    adminContent.innerHTML = renderAdminDashboardBody();
            }

            // Re-initialize Icons untuk konten baru
            lucide.createIcons();

            // Tutup sidebar di mobile jika diklik
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.add('-translate-x-full');
            }
        }

        // --- RENDER FUNCTIONS ---

        function renderAdminMetric(title, value, icon, classes) {
            return `
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-transparent flex items-center space-x-4 hover:shadow-md transition-shadow ${classes.replace('bg-', 'border-').split(' ')[0]}">
                <div class="p-3 rounded-full ${classes}">
                    <i data-lucide="${icon}" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">${title}</p>
                    <p class="text-2xl font-bold text-gray-800">${value}</p>
                </div>
            </div>`;
        }

        function renderSimpleContent(title, desc) {
            return `
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center py-20">
                <div class="inline-block p-4 bg-gray-50 rounded-full mb-4">
                    <i data-lucide="cone" class="w-10 h-10 text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-dark mb-2">${title}</h3>
                <p class="text-gray-500">${desc}</p>
            </div>`;
        }

        function renderAdminDashboardBody() {
            // Data ini bisa diambil dari variabel PHP Blade jika mau
            // var totalUser = {{ $totalUser ?? 0 }};

            return `
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                ${renderAdminMetric("Total Member", "{{ $totalUser ?? '0' }}", "users", "bg-blue-100 text-blue-600")}
                ${renderAdminMetric("Total Pendapatan", "Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}", "dollar-sign", "bg-green-100 text-green-600")}
                ${renderAdminMetric("Sedang Disewa", "{{ $pesananAktif ?? '0' }} Pcs", "boxes", "bg-yellow-100 text-yellow-600")}
                ${renderAdminMetric("Denda Aktif", "Rp 0", "alert-triangle", "bg-red-100 text-red-600")}
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-semibold mb-6 text-primary flex items-center">
                    <i data-lucide="trending-up" class="w-5 h-5 mr-2"></i> Tren Transaksi Bulanan
                </h2>
                <div class="h-64 flex items-end space-x-3 border-b border-l border-gray-200 pb-2 pl-2">
                    <div class="flex-1 bg-primary/20 rounded-t hover:bg-primary transition-all relative group" style="height: 30%;"></div>
                    <div class="flex-1 bg-primary/40 rounded-t hover:bg-primary transition-all relative group" style="height: 50%;"></div>
                    <div class="flex-1 bg-primary/60 rounded-t hover:bg-primary transition-all relative group" style="height: 70%;"></div>
                    <div class="flex-1 bg-primary/80 rounded-t hover:bg-primary transition-all relative group" style="height: 55%;"></div>
                    <div class="flex-1 bg-primary rounded-t hover:bg-primary transition-all relative group" style="height: 90%;"></div>
                    <div class="flex-1 bg-primary/50 rounded-t hover:bg-primary transition-all relative group" style="height: 65%;"></div>
                    <div class="flex-1 bg-primary/30 rounded-t hover:bg-primary transition-all relative group" style="height: 45%;"></div>
                    <div class="flex-1 bg-primary/10 rounded-t hover:bg-primary transition-all relative group" style="height: 20%;"></div>
                </div>
                <div class="flex justify-between mt-3 text-xs text-gray-500 font-medium">
                    <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>Mei</span><span>Jun</span><span>Jul</span><span>Agu</span>
                </div>
            </div>`;
        }

        function renderAdminKostumBody() {
            return `
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-dark">Daftar Kostum</h2>
                    <button class="px-4 py-2 bg-primary text-white rounded-lg flex items-center hover:bg-dark transition-colors text-sm font-bold" onclick="alert('Fitur Tambah Kostum (Modal)')">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Kostum
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold text-gray-500 uppercase tracking-wider">Nama Kostum</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-500 uppercase tracking-wider">Harga/Hari</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            ${dummyKostumList.map(k => `
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap font-medium text-dark">${k.name}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-primary font-bold">Rp ${k.price.toLocaleString('id-ID')}</td>
                                            <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">Tersedia</span></td>
                                            <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800 font-medium" onclick="alert('Edit ${k.name}')">Edit</button>
                                                <span class="text-gray-300">|</span>
                                                <button class="text-red-600 hover:text-red-800 font-medium" onclick="alert('Hapus ${k.name}')">Hapus</button>
                                            </td>
                                        </tr>
                                    `).join('')}
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 text-xs text-gray-500 text-center">
                    Menampilkan 5 dari Total Kostum
                </div>
            </div>`;
        }

        function renderAdminTransaksiBody() {
            const dummyTrans = [{
                    id: "TRX-001",
                    user: "Member Test",
                    item: "Tari Jaipong",
                    status: "Selesai",
                    class: "bg-green-100 text-green-700"
                },
                {
                    id: "TRX-002",
                    user: "Budi Santoso",
                    item: "Tari Kecak",
                    status: "Diproses",
                    class: "bg-yellow-100 text-yellow-700"
                },
                {
                    id: "TRX-003",
                    user: "Siti Aminah",
                    item: "Tari Piring",
                    status: "Menunggu Bayar",
                    class: "bg-red-100 text-red-700"
                },
            ];

            return `
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-semibold mb-6 text-dark">Riwayat Transaksi Terakhir</h2>
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-bold text-gray-500">ID Transaksi</th>
                            <th class="px-6 py-3 text-left font-bold text-gray-500">Penyewa</th>
                            <th class="px-6 py-3 text-left font-bold text-gray-500">Kostum</th>
                            <th class="px-6 py-3 text-left font-bold text-gray-500">Status</th>
                            <th class="px-6 py-3 text-left font-bold text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        ${dummyTrans.map(t => `
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-gray-500">${t.id}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium">${t.user}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">${t.item}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold ${t.class}">${t.status}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button class="text-primary hover:underline font-bold text-xs">Detail</button>
                                        </td>
                                    </tr>
                                `).join('')}
                    </tbody>
                </table>
            </div>`;
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        }

        // Initialize Icons & Load Default Dashboard
        window.onload = function() {
            lucide.createIcons();
            // Load Dashboard Content Default
            document.getElementById("admin-content-detail").innerHTML = renderAdminDashboardBody();
        };
    </script>
</body>

</html>
