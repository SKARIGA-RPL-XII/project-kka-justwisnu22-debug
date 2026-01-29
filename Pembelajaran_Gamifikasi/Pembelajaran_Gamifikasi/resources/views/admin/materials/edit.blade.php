<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Materi - AKU DEV</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lumanosimo:400&family=bitter:400,500,600,700&family=montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <nav class="bg-[#0F172A] text-white p-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <div class="flex items-center gap-4">
                <span>{{ Auth::user()->username }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 px-3 py-1 rounded">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex">
        <aside class="w-64 bg-white shadow-md min-h-screen">
            <nav class="p-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-gray-100 rounded">Dashboard</a></li>
                    <li><a href="{{ route('admin.quiz.index') }}" class="block p-2 hover:bg-gray-100 rounded">Quiz</a></li>
                    <li><a href="{{ route('admin.materials.index') }}" class="block p-2 bg-gray-100 rounded">Materi</a></li>
                    <li><a href="{{ route('admin.badges.index') }}" class="block p-2 hover:bg-gray-100 rounded">Badge</a></li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            <div class="mb-6 flex items-center justify-between">
                <!-- KIRI -->
                <div>
                    <h2 class="text-2xl font-bold">Edit Materi</h2>
                    <a href="{{ route('admin.materials.index') }}" class="text-blue-600 hover:text-blue-800">
                        ← Kembali ke Daftar Materi
                    </a>
                </div>

                <!-- KANAN -->
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Update Materi
                </button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('admin.materials.update', $material->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" name="title" id="title" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ old('title', $material->title) }}">
                            @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <input type="text" name="description" id="description" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ old('description', $material->description) }}" placeholder="Deskripsi singkat untuk card user">
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                            <textarea
                                name="content"
                                id="editor"
                                rows="12"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ old('content', $material->content) }}
                            </textarea>
                            @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>