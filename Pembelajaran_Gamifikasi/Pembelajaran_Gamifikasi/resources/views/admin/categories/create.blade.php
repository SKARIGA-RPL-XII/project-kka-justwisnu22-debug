@extends('layouts.admin')

@section('title', 'Tambah Kategori - AKU DEV')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.categories.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali
            </a>
        </div>
        <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Tambah Kategori</h2>
        <p class="text-slate-400">Buat kategori pembelajaran dengan tingkatan</p>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl p-8">
        @csrf

        @if($errors->any())
        <div class="mb-4 p-4 bg-red-500/20 border border-red-500 rounded-lg text-red-300">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="mb-8">
            <label class="block text-sm font-semibold text-slate-300 mb-3">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: Pemrograman Web">
        </div>

        <div class="mb-8">
            <label class="block text-sm font-semibold text-slate-300 mb-3">Foto Kategori</label>
            <input type="file" name="foto_kategori" accept="image/jpeg,image/jpg,image/png" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all duration-200">
            <p class="text-xs text-slate-400 mt-2">Format: JPG, JPEG, PNG (Opsional)</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-bold text-white mb-4">Tingkatan</h3>
            <div id="levels-container" class="space-y-4"></div>
        </div>

        <button type="button" onclick="addLevel()" class="mb-6 px-6 py-3 bg-green-600/80 hover:bg-green-600 text-white rounded-lg transition-all duration-200 font-semibold shadow-lg">
            + Tambah Tingkat
        </button>

        <div class="flex gap-3 pt-6 border-t border-slate-700/50">
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Simpan Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-8 py-3 rounded-lg transition-all duration-200 font-semibold flex items-center">Batal</a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    let levelCount = 0;

    function addLevel() {
        const container = document.getElementById('levels-container');
        const html = `
            <div class="level-item bg-slate-700/30 border border-slate-600/50 rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-white font-bold">Tingkat ${levelCount + 1}</h4>
                    ${levelCount > 0 ? '<button type="button" onclick="this.closest(\'.level-item\').remove()" class="text-red-400 hover:text-red-300 font-semibold">Hapus</button>' : ''}
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Judul Tingkat</label>
                        <input type="text" name="levels[${levelCount}][title]" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400" placeholder="Contoh: Dasar">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Tingkat Kesulitan</label>
                        <select name="levels[${levelCount}][difficulty_id]" required class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white">
                            @foreach($difficulties as $diff)
                            <option value="{{ $diff->id }}">{{ ucfirst($diff->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        levelCount++;
    }

    addLevel();
</script>
@endpush
