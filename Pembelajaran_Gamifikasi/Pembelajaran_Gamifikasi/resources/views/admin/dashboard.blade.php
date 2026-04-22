@extends('layouts.admin')

@section('title', 'Admin Dashboard - AKU DEV')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white mb-2 font-bitter">Dashboard Admin</h2>
        <p class="text-slate-400">Kelola konten pembelajaran Aku Dev</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
        @foreach([
            ['label'=>'User','value'=>$userCount,'color'=>'blue','icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0'],
            ['label'=>'Kategori','value'=>$categoryCount,'color'=>'yellow','icon'=>'M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z'],
            ['label'=>'Materi','value'=>$materialCount,'color'=>'green','icon'=>'M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z'],
            ['label'=>'Quiz','value'=>$quizCount,'color'=>'indigo','icon'=>'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label'=>'Badge','value'=>$badgeCount,'color'=>'purple','icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            ['label'=>'Quiz Dikerjakan','value'=>$quizDoneCount,'color'=>'pink','icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ] as $card)
        <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-5">
            <div class="w-10 h-10 bg-{{ $card['color'] }}-500/20 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-{{ $card['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/>
                </svg>
            </div>
            <p class="text-2xl font-bold text-white">{{ $card['value'] }}</p>
            <p class="text-slate-400 text-xs mt-1">{{ $card['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Grafik Row 1 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        {{-- Grafik Overview --}}
        <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6">
            <h3 class="text-white font-bold mb-4">Overview Konten</h3>
            <canvas id="overviewChart" height="220"></canvas>
        </div>

        {{-- Grafik Badge per User --}}
        <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6">
            <h3 class="text-white font-bold mb-4">Pengguna per Badge</h3>
            <canvas id="badgeChart" height="220"></canvas>
        </div>
    </div>

    {{-- Grafik Materi per Kategori --}}
    <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6 mb-10">
        <h3 class="text-white font-bold mb-4">Materi per Kategori</h3>
        <canvas id="categoryChart" height="100"></canvas>
    </div>

    {{-- Ringkasan Badge Terbaru --}}
    <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-700/50 flex justify-between items-center">
            <div>
                <h3 class="text-white font-bold">Badge Terbaru Diperoleh</h3>
                <p class="text-slate-400 text-sm">{{ $totalUserWithBadge }} pengguna telah mendapatkan badge</p>
            </div>
            <a href="{{ route('admin.reports.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">Lihat Semua →</a>
        </div>
        <table class="min-w-full">
            <thead class="bg-slate-700/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-300 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-300 uppercase">Badge</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-300 uppercase">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/50">
                @forelse($recentUserBadges as $row)
                <tr class="hover:bg-slate-700/30 transition-colors">
                    <td class="px-6 py-3 text-white text-sm font-medium">{{ $row['username'] }}</td>
                    <td class="px-6 py-3">
                        <span class="bg-purple-500/20 text-purple-300 px-3 py-1 rounded-full text-xs border border-purple-500/30">{{ $row['badge'] }}</span>
                    </td>
                    <td class="px-6 py-3 text-slate-400 text-sm">
                        {{ $row['earned_at'] ? \Carbon\Carbon::parse($row['earned_at'])->format('d M Y') : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-slate-400 text-sm">Belum ada pengguna yang mendapatkan badge</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartDefaults = {
        color: 'rgba(148,163,184,1)',
        grid: 'rgba(148,163,184,0.1)',
    };

    // ── Overview: Materi vs Quiz vs Quiz Dikerjakan ────────────────
    new Chart(document.getElementById('overviewChart'), {
        type: 'bar',
        data: {
            labels: @json($overviewLabels),
            datasets: [{
                label: 'Jumlah',
                data: @json($overviewData),
                backgroundColor: ['rgba(34,197,94,0.7)', 'rgba(99,102,241,0.7)', 'rgba(236,72,153,0.7)'],
                borderColor:     ['rgba(34,197,94,1)',   'rgba(99,102,241,1)',   'rgba(236,72,153,1)'],
                borderWidth: 2,
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: chartDefaults.color }, grid: { color: chartDefaults.grid } },
                y: { ticks: { color: chartDefaults.color, stepSize: 1 }, grid: { color: chartDefaults.grid }, beginAtZero: true },
            }
        }
    });

    // ── Badge: jumlah user per badge ───────────────────────────────
    new Chart(document.getElementById('badgeChart'), {
        type: 'doughnut',
        data: {
            labels: @json($badgeChartLabels),
            datasets: [{
                data: @json($badgeChartData),
                backgroundColor: [
                    'rgba(168,85,247,0.7)','rgba(59,130,246,0.7)','rgba(34,197,94,0.7)',
                    'rgba(251,191,36,0.7)','rgba(236,72,153,0.7)','rgba(20,184,166,0.7)',
                ],
                borderColor: 'rgba(30,41,59,1)',
                borderWidth: 3,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom', labels: { color: chartDefaults.color, padding: 12 } }
            }
        }
    });

    // ── Materi per Kategori ────────────────────────────────────────
    new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: {
            labels: @json($categoryChartLabels),
            datasets: [{
                label: 'Jumlah Materi',
                data: @json($categoryChartData),
                backgroundColor: 'rgba(34,197,94,0.7)',
                borderColor: 'rgba(34,197,94,1)',
                borderWidth: 2,
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: chartDefaults.color }, grid: { color: chartDefaults.grid } },
                y: { ticks: { color: chartDefaults.color, stepSize: 1 }, grid: { color: chartDefaults.grid }, beginAtZero: true },
            }
        }
    });
</script>
@endpush
