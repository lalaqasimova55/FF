<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task CMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-indigo-600 text-white px-6 py-4 flex items-center justify-between">
        <a href="{{ route('tasks.index') }}" class="text-xl font-bold">📋 Task CMS</a>
        <div class="flex gap-6">
            <a href="{{ route('tasks.index') }}" class="hover:underline">Tasklar</a>
            <a href="{{ route('categories.index') }}" class="hover:underline">Kateqoriyalar</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-8">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

</body>
</html>