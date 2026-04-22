@extends('layouts.admin')

@section('title', 'Edit Materi - AKU DEV')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.materials.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali
            </a>
        </div>
        <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Edit Materi</h2>
        <p class="text-slate-400">Perbarui konten pembelajaran</p>
    </div>

    <div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl p-8">
        <form method="POST" action="{{ route('admin.materials.update', $material->id) }}" id="editForm">
            @csrf @method('PUT')
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-3">Title</label>
                    <input type="text" name="title" id="title" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" value="{{ old('title', $material->title) }}" placeholder="Masukkan judul materi">
                    @error('title')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-3">Description</label>
                    <input type="text" name="description" id="description" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" value="{{ old('description', $material->description) }}" placeholder="Deskripsi singkat untuk card user">
                    @error('description')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-3">Kategori</label>
                    <select name="category_id" id="category_id" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white transition-all duration-200">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $material->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-3">Tingkat</label>
                    <select name="level_id" id="level_id" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white transition-all duration-200">
                        <option value="">Pilih Tingkat</option>
                        @foreach($levels as $level)
                        <option value="{{ $level->id }}" {{ old('level_id', $material->level_id) == $level->id ? 'selected' : '' }}>{{ $level->title }}</option>
                        @endforeach
                    </select>
                    @error('level_id')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-3">EXP Reward</label>
                    <input type="number" name="exp_reward" id="exp_reward" required min="0" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" value="{{ old('exp_reward', $material->exp_reward) }}" placeholder="Contoh: 50">
                    @error('exp_reward')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-3">Content</label>
                    <div class="bg-slate-700/50 border border-slate-600 rounded-lg overflow-hidden">
                        <textarea name="content" id="content" rows="12" class="w-full bg-transparent text-white placeholder-slate-400 resize-none border-0 focus:ring-0">{{ old('content', $material->content) }}</textarea>
                    </div>
                    @error('content')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Update Materi</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', { height: 400 });

    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const levelSelect = document.getElementById('level_id');
        levelSelect.innerHTML = '<option value="">Pilih Tingkat</option>';
        if (categoryId) {
            fetch(`/admin/categories/${categoryId}/levels`)
                .then(response => response.json())
                .then(levels => {
                    levels.forEach(level => {
                        const option = document.createElement('option');
                        option.value = level.id;
                        option.textContent = level.title;
                        levelSelect.appendChild(option);
                    });
                });
        }
    });
</script>
@endpush
