@extends('layouts.app')

@section('title','Radionice')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Radionice</h1>

    @if($workshops->isEmpty())
        <p>Nema dostupnih radionica.</p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($workshops as $w)
                <a href="{{ route('workshops.show', $w) }}" class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition">
                    <h2 class="font-semibold text-lg">{{ $w->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $w->city }} • {{ $w->address }}</p>
                    <p class="text-sm mt-2">⭐ {{ number_format($w->avg_rating,2) }} ({{ $w->reviews_count }})</p>
                    @if(!$w->is_verified)
                        <span class="inline-block mt-2 px-2 py-0.5 text-xs bg-yellow-100 text-yellow-800 rounded">Čeka verifikaciju</span>
                    @endif
                </a>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $workshops->links() }}
        </div>
    @endif
@endsection
