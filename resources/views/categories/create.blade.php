@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Yeni Kateqoriya</h1>
    <a href="{{ route('categories.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">← Geri</a>
</div>

<div class="bg-white rounded shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Ad *</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror"
                placeholder="Məs: İş, Şəxsi, Layihə">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Rəng *</label>
            <div class="flex gap-3">
                @php
                    $colors = ['#3b82f6', '#ef4444', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#06b6d4', '#f97316'];
                @endphp
                @foreach($colors as $color)
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="color" value="{{ $color }}"
                            {{ old('color') == $color ? 'checked' : '' }}
                            class="mr-2">
                        <div class="w-8 h-8 rounded border-2"
                            @style([
                                'background-color: ' . $color,
                                'border-color: ' . (old('color') == $color ? '#000' : '#ddd'),
                            ])></div>
                    </label>
                @endforeach
            </div>
            @error('color') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
            Saxla
        </button>
    </form>
</div>

@endsection
