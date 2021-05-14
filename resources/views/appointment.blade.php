<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment') }}
        </h2>
    </x-slot>

    <x-card-content-normal>

        <h2 class="cursor-default text-4xl pb-4 text-center">
            shift schedule
        </h2>

        <div class="hidden md:grid grid-cols-{{config('constants.scheduler.end_hour') - config('constants.scheduler.start_hour') + 1}} gap-2">
            @foreach($scheduler as $day => $hours)
                <div class="cursor-default py-2 bg-indigo-600 border-b-2"><b>
                    {{ \Carbon\Carbon::parse($day)->format('d/m/y') }}
                </b></div>
                @foreach ($hours as $hour) 
                    @if ($hour == 'taken')
                        <div class="cursor-default py-2 border-b-2 bg-gray-800 ">Taken.</div>
                    @else
                        <a href="/appointment/{{ $day }}/{{ $hour }}" onclick="return confirm('Do you really want to book the {{ $day }} shift at {{ $hour }}?')">
                        <div class="py-2 border-b-2 hover:bg-indigo-600 transition duration-300 ease-in-out">{{ $hour }} Hs.</div>
                        </a>
                    @endif
                @endforeach
            @endforeach
        </div>

        <div class="grid grid-cols-{{config('constants.scheduler.workable_days')}} gap-2 md:hidden">
            @foreach($scheduler as $day => $hours)
                <div class="grid grid-row-{{config('constants.scheduler.end_hour') - config('constants.scheduler.start_hour')}} gap-2">
                <div class="cursor-default py-2 bg-indigo-600 border-r-2"><b>
                    {{ \Carbon\Carbon::parse($day)->format('d/m/y') }}
                </b></div>
                @foreach ($hours as $hour) 
                    @if ($hour == 'taken')
                        <div class="cursor-default py-2 border-r-2 bg-gray-800 ">Taken.</div>
                    @else
                        <a href="/appointment/{{ $day }}/{{ $hour }}" onclick="return confirm('Do you really want to book the {{ $day }} shift at {{ $hour }}?')">
                        <div class="py-2 border-r-2 hover:bg-indigo-600 transition duration-300 ease-in-out">{{ $hour }} Hs.</div>
                        </a>
                    @endif
                @endforeach
                </div>
            @endforeach
        </div>

    </x-card-content-normal>

    <div class="text-center p-2 mx-auto my-4 align-middle">
        <form  class="mt-4" action="/appointment" method="GET">
            @csrf
            <input name="date" id="date" type="hidden" value="{{ $next5days }}">
            <x-button-golden>Next 5 Days >></x-button-golden>
        </form>
    </div>

</x-app-layout>
