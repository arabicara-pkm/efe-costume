<!DOCTYPE html>
<html lang="id">

<head>
    <title>Kelola Kostum - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-50 text-slate-800 font-sans">

    <div class="max-w-7xl mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-[#9B2C2C]">Kelola Kostum</h1>
            <div class="flex gap-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
                </a>
                <a href="{{ route('admin.kostum.create') }}"
                    class="px-4 py-2 bg-[#9B2C2C] text-white rounded-lg hover:bg-[#7f1d1d] flex items-center shadow">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Kostum
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border border-green-200 flex items-center">
                <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Gambar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama &
                            Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga
                            Sewa</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Stok
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kostums as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($item->gambar)
                                    <img src="{{ asset($item->gambar) }}"
                                        class="h-16 w-16 rounded object-cover border border-gray-200">
                                @else
                                    <div
                                        class="h-16 w-16 rounded bg-gray-100 flex items-center justify-center text-xs text-gray-400">
                                        No IMG</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $item->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $item->kategori }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#9B2C2C] font-bold">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->stok }} Pcs
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('admin.kostum.edit', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-900 inline-block font-bold">Edit</a>

                                <form action="{{ route('admin.kostum.destroy', $item->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus kostum ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 font-bold ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                Belum ada data kostum. Silakan tambah data baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $kostums->links() }}
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
