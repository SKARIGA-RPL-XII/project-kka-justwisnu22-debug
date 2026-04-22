@extends('layouts.admin')

@section('title', 'Laporan - AKU DEV')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Laporan</h2>
    <p class="text-slate-400">Ringkasan data pengguna, badge, dan materi</p>
</div>

{{-- Ringkasan Angka --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6">
        <p class="text-slate-400 text-sm mb-1">Total Penerima Badge</p>
        <p class="text-4xl font-bold text-purple-400">{{ $userBadges->count() }}</p>
    </div>
    <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6">
        <p class="text-slate-400 text-sm mb-1">Total Materi</p>
        <p class="text-4xl font-bold text-green-400">{{ $materialsPerCategory->sum('materials_count') }}</p>
    </div>
    <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6">
        <p class="text-slate-400 text-sm mb-1">Total Quiz Dikerjakan</p>
        <p class="text-4xl font-bold text-blue-400">{{ $totalQuizDone }}</p>
    </div>
</div>

{{-- Tabel Laporan Badge User --}}
<div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden mb-10">
    <div class="px-6 py-4 border-b border-slate-700/50">
        <h3 class="text-lg font-bold text-white">Laporan Pengguna Badge</h3>
        <p class="text-slate-400 text-sm">Daftar pengguna yang telah mendapatkan badge</p>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-slate-700/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Nama User</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Nama Badge</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Tanggal Didapat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/50">
                @forelse($userBadges as $i => $row)
                <tr class="hover:bg-slate-700/30 transition-colors">
                    <td class="px-6 py-4 text-slate-400 text-sm">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 text-white font-medium">{{ $row['username'] }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-purple-500/20 text-purple-300 px-3 py-1 rounded-full text-sm border border-purple-500/30">
                            {{ $row['badge'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-300 text-sm">
                        {{ $row['earned_at'] ? \Carbon\Carbon::parse($row['earned_at'])->format('d M Y, H:i') : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400">Belum ada pengguna yang mendapatkan badge</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Grafik Pengguna per Badge --}}
<div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden mb-10">
    <div class="px-6 py-4 border-b border-slate-700/50">
        <h3 class="text-lg font-bold text-white">Grafik Pengguna per Badge</h3>
        <p class="text-slate-400 text-sm">Jumlah pengguna yang mendapatkan setiap badge</p>
    </div>
    <div class="p-6">
        <canvas id="badgeChart" width="400" height="200"></canvas>
    </div>
</div>

{{-- Tabel Laporan Materi per Kategori --}}
<div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl shadow-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-700/50">
        <h3 class="text-lg font-bold text-white">Laporan Materi per Kategori</h3>
        <p class="text-slate-400 text-sm">Jumlah materi yang tersedia di setiap kategori</p>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-slate-700/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Jumlah Materi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/50">
                @forelse($materialsPerCategory as $i => $cat)
                <tr class="hover:bg-slate-700/30 transition-colors">
                    <td class="px-6 py-4 text-slate-400 text-sm">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 text-white font-medium">{{ $cat->name }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-500/20 text-green-300 px-3 py-1 rounded-full text-sm border border-green-500/30">
                            {{ $cat->materials_count }} Materi
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-slate-400">Belum ada data materi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const badgeStats = @json($badgeStats);

        const labels = badgeStats.map(stat => stat.badge);
        const data = badgeStats.map(stat => stat.count);

        const ctx = document.getElementById('badgeChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: data,
                    backgroundColor: 'rgba(147, 51, 234, 0.6)',
                    borderColor: 'rgba(147, 51, 234, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#cbd5e1'
                        },
                        grid: {
                            color: '#475569'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#cbd5e1'
                        },
                        grid: {
                            color: '#475569'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#cbd5e1'
                        }
                    }
                }
            }
        });
    });
</script>
@endpush