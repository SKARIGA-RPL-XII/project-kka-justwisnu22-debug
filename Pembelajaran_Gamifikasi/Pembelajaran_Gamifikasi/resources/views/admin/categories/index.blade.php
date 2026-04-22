@extends('layouts.admin')

@section('title', 'Kelola Kategori - AKU DEV')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-3xl font-bold text-white mb-2 font-inter">Kategori Management</h2>
        <p class="text-slate-400">Kelola kategori pembelajaran</p>
    </div>
    <a href="{{ route('admin.categories.create') }}">
        <button class="bg-white px-4 py-2" style="border-radius: 10px;">
            Tambah
        </button>
    </a>
</div>

@if(session('success'))
<div class="bg-green-500/20 border border-green-500/50 text-green-300 px-6 py-4 rounded-xl mb-6">
    <div class="flex items-center gap-3">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        {{ session('success') }}
    </div>
</div>
@endif

<div class="bg-slate-800/30 backdrop-blur-sm border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-slate-700/50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase">ID</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase">Nama Kategori</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase">Jumlah Tingkat</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700/50 " style="border: 1px; border-color: white;">
            @php $no = 0; @endphp
            @forelse($categories as $category)
            <tr class="hover:bg-slate-700/30 transition" style="border: 1px; border-color: white;">
                <td class="px-6 py-4 whitespace-nowrap text-slate-300 font-medium">{{ ++$no }}</td>
                <td class="px-6 py-4 text-white font-semibold">{{ $category->name }}</td>
                <td class="px-6 py-4 text-slate-300">{{ $category->levels->count() }} Tingkat</td>
                <td class="px-6 py-4">
                    <div class="flex gap-3">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 px-4 py-2 rounded-lg border border-blue-500/30 transition">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-300 px-4 py-2 rounded-lg border border-red-500/30 transition" onclick="return confirm('Hapus?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-slate-400 text-lg">Tidak ada kategori</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    thead {
        border: 1px solid white;
    }

    th {
        border: 1px solid white;
    }

    td {
        border: 1px solid white;
    }
</style>
@endsection