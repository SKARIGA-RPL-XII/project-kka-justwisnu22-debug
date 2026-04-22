@extends('layouts.admin')

@section('title', 'Tambah Materi - AKU DEV')

@push('styles')
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
@endpush

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('admin.materials.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali
                </a>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Tambah Materi Baru</h2>
            <p class="text-slate-400">Buat konten pembelajaran baru</p>
        </div>

        <div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl p-8">
            <form action="{{ route('admin.materials.store') }}" method="POST" id="createForm">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Judul Materi</label>
                        <input type="text" name="title" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Masukkan judul materi">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Deskripsi Singkat</label>
                        <textarea name="description" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" rows="3" placeholder="Deskripsi singkat untuk card user"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Kategori</label>
                        <select name="category_id" id="category_id" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white transition-all duration-200">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Tingkat</label>
                        <select name="level_id" id="level_id" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white transition-all duration-200">
                            <option value="">Pilih Kategori Dulu</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">EXP Reward</label>
                        <input type="number" name="exp_reward" required min="0" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: 50">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Konten Materi</label>
                        <div class="bg-slate-700/50 border border-slate-600 rounded-lg overflow-hidden">
                            <textarea name="content" id="content" required class="w-full bg-transparent text-white placeholder-slate-400 resize-none border-0 focus:ring-0" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end pt-6">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Simpan Materi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    CKEDITOR.replace('content', { height: 400 });

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
@endpush
