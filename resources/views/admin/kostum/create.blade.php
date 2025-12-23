<!DOCTYPE html>
<html lang="id">

<head>
    <title>Tambah Kostum - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-slate-800 font-sans p-8">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-[#9B2C2C] mb-6 border-b pb-4">Tambah Kostum Baru</h2>

        <form action="{{ route('admin.kostum.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-bold mb-2">Nama Kostum</label>
                <input type="text" name="nama" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#9B2C2C] outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Kategori</label>
                    <select name="kategori" class="w-full p-3 border border-gray-300 rounded-lg bg-white">
                        <option value="Tari Bali">Tari Bali</option>
                        <option value="Tari Jawa">Tari Jawa</option>
                        <option value="Tari Sunda">Tari Sunda</option>
                        <option value="Tari Sumatera">Tari Sumatera</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Stok Awal</label>
                    <input type="number" name="stok" required class="w-full p-3 border border-gray-300 rounded-lg">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Harga Sewa (Per Hari)</label>
                <input type="number" name="harga" required class="w-full p-3 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" required class="w-full p-3 border border-gray-300 rounded-lg"></textarea>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Upload Gambar</label>
                <input type="file" name="gambar" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#9B2C2C] hover:file:bg-red-100">
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('admin.kostum.index') }}"
                    class="w-1/3 py-3 border border-gray-300 text-center rounded-lg hover:bg-gray-50">Batal</a>
                <button type="submit"
                    class="w-2/3 py-3 bg-[#9B2C2C] text-white font-bold rounded-lg hover:bg-[#7f1d1d]">Simpan
                    Data</button>
            </div>
        </form>
    </div>

</body>

</html>
