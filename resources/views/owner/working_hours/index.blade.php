@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Radno vreme — {{ $workshop->name }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Lista postojećih stavki --}}
        <table class="w-full border mb-6">
            <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Dan</th>
                <th class="p-2 text-left">Otvoreno</th>
                <th class="p-2 text-left">Zatvoreno</th>
                <th class="p-2 text-left">Pauza</th>
                <th class="p-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($hours as $h)
                <tr class="border-t">
                    <td class="p-2">{{ $h->day_of_week }}</td>
                    <td class="p-2">{{ \Illuminate\Support\Str::of($h->open_at)->substr(0,5) }}</td>
                    <td class="p-2">{{ \Illuminate\Support\Str::of($h->close_at)->substr(0,5) }}</td>
                    <td class="p-2">
                        @if($h->break_start && $h->break_end)
                            {{ \Illuminate\Support\Str::of($h->break_start)->substr(0,5) }}–{{ \Illuminate\Support\Str::of($h->break_end)->substr(0,5) }}
                        @else
                            —
                        @endif
                    </td>
                    <td class="p-2 text-right">
                        <form method="POST" action="{{ route('owner.working_hours.destroy', $h) }}">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded"
                                    onclick="return confirm('Obrisati ovo radno vreme?')">Obriši</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td class="p-2" colspan="5">Nema unetog radnog vremena.</td></tr>
            @endforelse
            </tbody>
        </table>

        {{-- Forma za dodavanje novog dana --}}
        <h2 class="text-xl font-semibold mb-2">Dodaj dan</h2>
        <form method="POST" action="{{ route('owner.working_hours.store', $workshop) }}" class="grid gap-3 md:grid-cols-5">
            @csrf
            <div>
                <label class="block text-sm mb-1">Dan (0–6)</label>
                <input type="number" name="day_of_week" min="0" max="6" value="{{ old('day_of_week') }}" class="border p-2 w-full">
                @error('day_of_week') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Otvoreno</label>
                <input type="time" name="open_at" value="{{ old('open_at') }}" class="border p-2 w-full">
                @error('open_at') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Zatvoreno</label>
                <input type="time" name="close_at" value="{{ old('close_at') }}" class="border p-2 w-full">
                @error('close_at') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Pauza od</label>
                <input type="time" name="break_start" value="{{ old('break_start') }}" class="border p-2 w-full">
                @error('break_start') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Pauza do</label>
                <input type="time" name="break_end" value="{{ old('break_end') }}" class="border p-2 w-full">
                @error('break_end') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="md:col-span-5">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Sačuvaj</button>
            </div>
        </form>
    </div>
@endsection
