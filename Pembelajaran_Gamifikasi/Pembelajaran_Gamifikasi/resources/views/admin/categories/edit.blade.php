<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Kategori</h1>
        
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="bg-white rounded shadow p-6">
            @csrf @method('PUT')
            
            <div class="mb-4">
                <label class="block font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ $category->name }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div id="levels-container">
                <h3 class="font-bold mb-3">Tingkatan</h3>
                @foreach($category->levels as $index => $level)
                <div class="level-item border p-4 rounded mb-3">
                    <label class="block mb-2">Tingkat {{ $index + 1 }}</label>
                    <input type="text" name="levels[{{ $index }}][title]" value="{{ $level->title }}" required class="w-full border rounded px-3 py-2 mb-2">
                    <select name="levels[{{ $index }}][difficulty_id]" required class="w-full border rounded px-3 py-2">
                        @foreach($difficulties as $diff)
                        <option value="{{ $diff->id }}" {{ $level->difficulty_id == $diff->id ? 'selected' : '' }}>{{ $diff->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach
            </div>
            
            <button type="button" onclick="addLevel()" class="mb-4 px-4 py-2 bg-green-600 text-white rounded">+ Tambah Tingkat</button>
            
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded">Update</button>
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded">Batal</a>
            </div>
        </form>
    </div>
    
    <script>
        let levelCount = {{ $category->levels->count() }};
        function addLevel() {
            const container = document.getElementById('levels-container');
            const html = `
                <div class="level-item border p-4 rounded mb-3">
                    <div class="flex justify-between mb-2">
                        <label class="font-semibold">Tingkat ${levelCount + 1}</label>
                        <button type="button" onclick="this.closest('.level-item').remove()" class="text-red-600">Hapus</button>
                    </div>
                    <input type="text" name="levels[${levelCount}][title]" required class="w-full border rounded px-3 py-2 mb-2">
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
