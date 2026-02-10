<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Tambah Kategori</h1>
        
        <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white rounded shadow p-6">
            @csrf
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="name" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div id="levels-container">
                <h3 class="font-bold mb-3">Tingkatan</h3>
                <div class="level-item border p-4 rounded mb-3">
                    <label class="block mb-2">Judul Tingkat 1</label>
                    <input type="text" name="levels[0][title]" required class="w-full border rounded px-3 py-2 mb-2">
                    <label class="block mb-2">Tingkat Kesulitan</label>
                    <select name="levels[0][difficulty_id]" required class="w-full border rounded px-3 py-2">
                        @foreach($difficulties as $diff)
                        <option value="{{ $diff->id }}">{{ $diff->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <button type="button" onclick="addLevel()" class="mb-4 px-4 py-2 bg-green-600 text-white rounded">+ Tambah Tingkat</button>
            
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded">Simpan</button>
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded">Batal</a>
            </div>
        </form>
    </div>
    
    <script>
        let levelCount = 1;
        function addLevel() {
            const container = document.getElementById('levels-container');
            const html = `
                <div class="level-item border p-4 rounded mb-3">
                    <div class="flex justify-between mb-2">
                        <label class="font-semibold">Tingkat ${levelCount + 1}</label>
                        <button type="button" onclick="this.closest('.level-item').remove()" class="text-red-600">Hapus</button>
                    </div>
                    <input type="text" name="levels[${levelCount}][title]" required class="w-full border rounded px-3 py-2 mb-2" placeholder="Judul">
                    <select name="levels[${levelCount}][difficulty_id]" required class="w-full border rounded px-3 py-2">
                        @foreach($difficulties as $diff)
                        <option value="{{ $diff->id }}">{{ $diff->name }}</option>
                        @endforeach
                    </select>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            levelCount++;
        }
    </script>
</body>
</html>
