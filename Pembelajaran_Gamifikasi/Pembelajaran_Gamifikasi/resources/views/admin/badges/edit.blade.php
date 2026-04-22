@extends('layouts.admin')

@section('title', 'Edit Badge - AKU DEV')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('admin.badges.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali
                </a>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Edit Badge</h2>
            <p class="text-slate-400">Perbarui pencapaian pengguna</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-500/20 border border-red-500/50 text-red-300 px-6 py-4 rounded-xl mb-6 backdrop-blur-sm shadow-lg">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <div>
                    <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl p-8">
            <form method="POST" action="{{ route('admin.badges.update', $badge->id) }}">
                @csrf @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Title Badge</label>
                        <input type="text" name="title" value="{{ old('title', $badge->title) }}" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: Pemula Sejati" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Syarat Level</label>
                        <input type="number" name="level_requirement" value="{{ old('level_requirement', $badge->level_requirement) }}" min="1" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: 5" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Hadiah Title</label>
                        <input type="text" name="reward_title" value="{{ old('reward_title', $badge->reward_title) }}" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400 transition-all duration-200" placeholder="Contoh: Rookie Developer" required>
                        <p class="text-sm text-slate-400 mt-2">Title ini akan bisa dipilih user di profile mereka</p>
                    </div>
                    <div class="pt-6">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Update Badge</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
