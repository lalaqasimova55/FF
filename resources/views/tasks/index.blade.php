@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tasklar</h1>
    <a href="{{ route('tasks.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Yeni Task</a>
</div>

{{-- Filter & Search --}}
<form method="GET" action="{{ route('tasks.index') }}" class="bg-white p-4 rounded shadow mb-6 flex flex-wrap gap-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Task axtar..."
        class="border rounded px-3 py-2 flex-1 min-w-[200px]">

    <select name="status" class="border rounded px-3 py-2">
        <option value="">Bütün statuslar</option>
        <option value="pending"   {{ request('status') == 'pending'   ? 'selected' : '' }}>Gözləyir</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Tamamlandı</option>
    </select>

    <select name="category" class="border rounded px-3 py-2">
        <option value="">Bütün kateqoriyalar</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Filter</button>
    <a href="{{ route('tasks.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Sıfırla</a>
</form>

{{-- Task Table --}}
<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">Başlıq</th>
                <th class="px-4 py-3 text-left">Kateqoriya</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Deadline</th>
                <th class="px-4 py-3 text-left">Əməliyyatlar</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($tasks as $task)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $task->title }}</td>
                <td class="px-4 py-3">
                    @if($task->category)
                        <span class="px-2 py-1 rounded text-white text-xs" @style(['background-color: ' . $task->category->color])>
                            {{ $task->category->name }}
                        </span>
                    @else
                        <span class="text-gray-400">—</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="px-2 py-1 rounded text-xs font-medium
                            {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $task->status === 'completed' ? '✓ Tamamlandı' : '⏳ Gözləyir' }}
                        </button>
                    </form>
                </td>
                <td class="px-4 py-3 text-gray-600">
                    {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d.m.Y') : '—' }}
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:underline">Düzəliş</a>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                        onsubmit="return confirm('Silinsin?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-400">Heç bir task tapılmadı.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $tasks->withQueryString()->links() }}
</div>

@endsection