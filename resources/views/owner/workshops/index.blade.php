@extends('layouts.app')

@section('title','Moji servisi')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Moji servisi</h1>
        <a href="{{ route('owner.workshops.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Dodaj servis</a>
    </div>

    @if($workshops->isEmpty())
        <p>Još nemaš dodat nijedan servis.</p>
    @else
        <div class="bg-white rounded-lg shadow">
            <table class="w-full">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3">Naziv</th>
                    <th class="text-left p-3">Grad</th>
                    <th class="text-left p-3">Verifikovan</th>
                    <th class="p-3"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($workshops as $w)
                    <tr class="border-t">
                        <td class="p-3 font-medium">{{ $w->name }}</td>
                        <td class="p-3">{{ $w->city }}</td>
                        <td class="p-3">
                            @if($w->is_verified)
                                <span class="text-green-700">Da</span>
                            @else
                                <span class="text-yellow-700">Ne</span>
                            @endif
                        </td>
                        <td class="p-3 text-right">
                            <a href="{{ route('owner.workshops.edit', $w) }}" class="text-blue-600 hover:underline mr-3">Uredi</a>
                            <a href="{{ route('owner.working_hours.index', $w) }}" class="text-gray-700 hover:underline mr-3">Radno vreme</a>
                            <a href="{{ route('owner.closed_periods.index', $w) }}" class="text-gray-700 hover:underline mr-3">Neradni periodi</a>
                            <form method="POST" action="{{ route('owner.workshops.destroy', $w) }}" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Obrisati ovaj servis?')">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $workshops->links() }}
        </div>
    @endif
@endsection
