@extends('layouts.app')

@section('title', $workshop->name)

@section('content')
    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-5">
                <h1 class="text-2xl font-bold">{{ $workshop->name }}</h1>
                <p class="text-gray-600">{{ $workshop->city }} • {{ $workshop->address }} • {{ $workshop->phone }}</p>
                <p class="mt-3">{{ $workshop->description }}</p>
                <p class="mt-2 text-sm">⭐ {{ number_format($workshop->avg_rating,2) }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 mt-6">
                <h2 class="text-xl font-semibold mb-3">Usluge</h2>
                @forelse($workshop->services as $ws)
                    <div class="flex items-center justify-between border-t py-3 first:border-t-0">
                        <div>
                            <div class="font-medium">{{ $ws->serviceType->name }}</div>
                            <div class="text-sm text-gray-600">{{ $ws->duration_minutes }} min</div>
                        </div>
                        <div class="font-semibold">{{ number_format($ws->price,2) }} RSD</div>
                    </div>
                @empty
                    <p>Nema definisanih usluga.</p>
                @endforelse
            </div>

            <div class="bg-white rounded-lg shadow p-5 mt-6">
                <h2 class="text-xl font-semibold mb-3">Poslednje recenzije</h2>
                @forelse($workshop->reviews as $r)
                    <div class="border-t py-3 first:border-t-0">
                        <div class="font-medium">⭐ {{ $r->rating }}</div>
                        <div class="text-sm text-gray-700">{{ $r->comment }}</div>
                    </div>
                @empty
                    <p>Još nema recenzija.</p>
                @endforelse
            </div>
        </div>

        <aside>
            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-lg font-semibold mb-3">Radno vreme</h3>
                @php $days = [0=>'Ned',1=>'Pon',2=>'Uto',3=>'Sre',4=>'Čet',5=>'Pet',6=>'Sub']; @endphp
                @forelse($workshop->workingHours as $wh)
                    <div class="flex justify-between py-2 border-t first:border-t-0">
                        <span>{{ $days[$wh->day_of_week] ?? $wh->day_of_week }}</span>
                        <span>
                        {{ \Illuminate\Support\Str::of($wh->open_at)->substr(0,5) }}
                        –
                        {{ \Illuminate\Support\Str::of($wh->close_at)->substr(0,5) }}
                            @if($wh->break_start && $wh->break_end)
                                <span class="text-xs text-gray-500">(pauza
                                {{ \Illuminate\Support\Str::of($wh->break_start)->substr(0,5) }}–{{ \Illuminate\Support\Str::of($wh->break_end)->substr(0,5) }})
                            </span>
                            @endif
                    </span>
                    </div>
                @empty
                    <p>Nije uneto radno vreme.</p>
                @endforelse
            </div>
        </aside>
    </div>
@endsection
