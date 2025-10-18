@extends('layouts.app')

@section('title','Uredi servis')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Uredi: {{ $workshop->name }}</h1>

    <form method="POST" action="{{ route('owner.workshops.update', $workshop) }}" class="bg-white rounded-lg shadow p-5 grid gap-4 md:grid-cols-2">
        @csrf @method('PUT')
        <div class="md:col-span-2">
            <label class="block text-sm mb-1">Naziv</label>
            <input type="text" name="name" value="{{ old('name', $workshop->name) }}" class="border p-2 w-full" required>
            @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Grad</label>
            <input type="text" name="city" value="{{ old('city', $workshop->city) }}" class="border p-2 w-full" required>
            @error('city') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Adresa</label>
            <input type="text" name="address" value="{{ old('address', $workshop->address) }}" class="border p-2 w-full" required>
            @error('address') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Telefon</label>
            <input type="text" name="phone" value="{{ old('phone', $workshop->phone) }}" class="border p-2 w-full" required>
            @error('phone') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm mb-1">Opis (opciono)</label>
            <textarea name="description" rows="4" class="border p-2 w-full">{{ old('description', $workshop->description) }}</textarea>
            @error('description') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>
        <div class="md:col-span-2">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Sačuvaj izmene</button>
            <a href="{{ route('owner.workshops.index') }}" class="ml-2 text-gray-700 hover:underline">Nazad</a>
        </div>
    </form>
@endsection
