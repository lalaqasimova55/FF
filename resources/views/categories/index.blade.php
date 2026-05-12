@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kateqoriyalar</h1>
    <a href="{{ route('categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Yeni Kateqoriya</a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">Ad</th>
                <th class="px-4 py-3 text-left">Rəng</th>
                <th class="px-4 py-3 text-left">Task Sayı</th>
                <th class="px-4 py-3 text-left">Əməliyyatlar</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $category)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $category->name }}</td>
                <td class="px-4 py-3">
                    <div class="w-8 h-8 rounded"  @style(['background-color: ' . $category->color,
                                'border-color: ' . (old('color') == $category->color ? '#000' : '#ddd'),])></div>
                </td>
                <td class="px-4 py-3 text-gray-600">
                    {{ $category->tasks_count }}
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:underline">Düzəliş</a>
                    <form method="POST" action="{{ route('categories.destroy', $category) }}"
                        onsubmit="return confirm('Silinsin?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-8 text-center text-gray-400">Heç bir kateqoriya tapılmadı.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
