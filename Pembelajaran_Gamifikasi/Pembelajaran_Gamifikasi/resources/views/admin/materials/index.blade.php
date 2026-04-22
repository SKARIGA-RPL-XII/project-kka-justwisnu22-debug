@extends('layouts.admin')

@section('title', 'Materials Management - AKU DEV')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2 font-inter">Materials Management</h2>
            <p class="text-slate-400">Kelola konten pembelajaran</p>
        </div>
        <a href="{{ route('admin.materials.create') }}">
            <button title="Add New" class="group cursor-pointer outline-none transition-transform duration-300 hover:rotate-90">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" class="fill-none stroke-[#2457D6] transition-all duration-300 group-hover:fill-[#0B3FAF] group-hover:stroke-white group-hover:drop-shadow-[0_0_12px_rgba(36,87,214,0.8)] group-active:scale-95">
                    <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke-width="1.5" />
                    <path d="M8 12H16" stroke-width="1.5" />
                    <path d="M12 16V8" stroke-width="1.5" />
                </svg>
            </button>
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-500/20 border border-green-500/50 text-green-300 px-6 py-4 rounded-xl mb-6 backdrop-blur-sm shadow-lg">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @php
                    $no=0;
                    @endphp
                    @forelse($materials ?? [] as $material)
                    <tr class="hover:bg-slate-700/30 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-slate-300 font-medium">{{ ++$no }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-white font-semibold">{{ $material->title }}</td>
                        <td class="px-6 py-4 max-w-md">
                            <div class="text-sm text-slate-400 line-clamp-2">{{ $material->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-slate-300">{{ $material->category->name ?? '-' }}</div>
                            <div class="text-xs text-slate-500">{{ $material->level->title ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.materials.edit', $material->id) }}" class="bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 px-4 py-2 rounded-lg transition-all duration-200 border border-blue-500/30">Edit</a>
                                <form method="POST" action="{{ route('admin.materials.destroy', $material->id) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-300 px-4 py-2 rounded-lg transition-all duration-200 border border-red-500/30" onclick="return confirm('Yakin hapus?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p class="text-slate-400 text-lg">Tidak ada data materi</p>
                                <p class="text-slate-500 text-sm">Mulai dengan menambahkan materi pembelajaran pertama</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
