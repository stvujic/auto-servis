@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Neradni periodi — {{ $workshop->name }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Lista postojećih perioda --}}
        <table class="w-full border mb-6">
            <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Početak</th>
                <th class="p-2 text-left">Kraj</th>
                <th class="p-2 text-left">Razlog</th>
                <th class="p-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($periods as $p)
                <tr class="border-t">
                    <td class="p-2">{{ \Carbon\Carbon::parse($p->starts_at)->format('Y-m-d H:i') }}</td>
                    <td class="p-2">{{ \Carbon\Carbon::parse($p->ends_at)->format('Y-m-d H:i') }}</td>
                    <td class="p-2">{{ $p->reason ?? '—' }}</td>
                    <td class="p-2 text-right">
                        <form method="POST" action="{{ route('owner.closed_periods.destroy', $p) }}">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded"
                                    onclick="return confirm('Obrisati ovaj period?')">Obriši</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td class="p-2" colspan="4">Nema unetih perioda.</td></tr>
            @endforelse
            </tbody>
        </table>

        {{-- Forma za dodavanje novog perioda --}}
        <h2 class="text-xl font-semibold mb-2">Dodaj period</h2>
        <form method="POST" action="{{ route('owner.closed_periods.store', $workshop) }}" class="grid gap-3 md:grid-cols-3">
            @csrf
            <div>
                <label class="block text-sm mb-1">Početak</label>
                <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}" class="border p-2 w-full">
                @error('starts_at') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Kraj</label>
                <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}" class="border p-2 w-full">
                @error('ends_at') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm mb-1">Razlog (opciono)</label>
                <input type="text" name="reason" value="{{ old('reason') }}" class="border p-2 w-full">
                @error('reason') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="md:col-span-3">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Sačuvaj</button>
            </div>
        </form>
    </div>
@endsection
