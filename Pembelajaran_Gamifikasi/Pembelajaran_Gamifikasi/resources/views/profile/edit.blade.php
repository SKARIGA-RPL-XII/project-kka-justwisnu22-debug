<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gradient-to-br from-[#03112F] via-[#093595] to-[#03112F] min-h-screen">

@include('components.navbar')

<div class="container mx-auto px-4 py-12">
    <div class="max-w-xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-8 text-white">
            <h1 class="text-3xl font-bold">Edit Profile</h1>
            <p class="text-blue-200 text-sm mt-1">Perbarui identitas akunmu</p>
        </div>

        <!-- Error -->
        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-400 text-red-200 px-4 py-3 rounded mb-6">
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- FOTO PROFIL -->
                <div class="flex flex-col items-center mb-8">
                    <div class="w-28 h-28 rounded-full overflow-hidden ring-4 ring-blue-500/30 mb-3">
                        @if($user->photo_profile)
                            <img src="{{ route('profile.photo', $user->id) }}" class="w-full h-full object-cover" id="preview">
                        @else
                            <img src="{{ asset('Images/dummy_user.png') }}" class="w-full h-full object-cover" id="preview">
                        @endif
                    </div>

                    <label class="cursor-pointer text-sm text-blue-600 hover:underline">
                        Ganti Foto Profil
                        <input type="file" name="photo_profile" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </label>
                </div>

                <!-- USERNAME -->
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username"
                        value="{{ old('username', $user->username) }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                </div>

                <!-- PASSWORD -->
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 pr-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Kosongkan jika tidak diubah">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                            👁️
                        </button>
                    </div>
                </div>

                <!-- TITLE -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <select name="title"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Belum ada title</option>
                        @foreach($earnedBadges as $badge)
                            <option value="{{ $badge->reward_title }}"
                                {{ old('title', $user->title) == $badge->reward_title ? 'selected' : '' }}>
                                {{ $badge->reward_title }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Title dari badge yang sudah kamu dapatkan</p>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
            </form>

        </div>

        <!-- BACK -->
        <div class="text-center mt-6">
            <a href="{{ route('profile.show') }}" class="text-blue-200 hover:underline text-sm">
                ← Kembali ke Profil
            </a>
        </div>

    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('preview').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}

function togglePassword() {
    const pass = document.getElementById('password');
    pass.type = pass.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>