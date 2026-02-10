<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi - Admin</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Tambah Materi Baru</h1>
        
        <form action="{{ route('admin.materials.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Judul Materi</label>
                <input type="text" name="title" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Deskripsi Singkat</label>
                <textarea name="description" required class="w-full border rounded px-3 py-2" rows="3"></textarea>
            </div>
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Kategori</label>
                <select name="category_id" id="category_id" required class="w-full border rounded px-3 py-2">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Tingkat</label>
                <select name="level_id" id="level_id" required class="w-full border rounded px-3 py-2">
                    <option value="">Pilih Kategori Dulu</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Konten Materi</label>
                <textarea name="content" id="content" required class="w-full border rounded px-3 py-2" rows="10"></textarea>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.materials.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>
    
    <script>
        CKEDITOR.replace('content');
        
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            const levelSelect = document.getElementById('level_id');
            
            if (!categoryId) {
                levelSelect.innerHTML = '<option value="">Pilih Kategori Dulu</option>';
                return;
            }
            
            fetch(`/admin/categories/${categoryId}/levels`)
                .then(res => res.json())
                .then(levels => {
                    levelSelect.innerHTML = '<option value="">Pilih Tingkat</option>';
                    levels.forEach(level => {
                        levelSelect.innerHTML += `<option value="${level.id}">${level.title} (${level.difficulty.name})</option>`;
                    });
                });
        });
    </script>
</body>
</html>
