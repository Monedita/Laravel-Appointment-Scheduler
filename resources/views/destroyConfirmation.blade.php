<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-card-content-normal>
        <div class="grid grid-cols-2">

        <div class="col-span-2">
            <h2 class="cursor-default text-4xl pb-4 text-center">
                Delete Appointment
            </h2>
        
            <h2 class="font-semibold text-xl leading-tight">
                <p>
                    ¿Do you really want to delete the appointment of <b>{{ $appointment->user->name }}</b> from day  
                    {{ \Carbon\Carbon::parse($appointment->date)->format('l d/m/y') }} 
                    at {{$appointment->hour}} Hs.?
                </p>
                <br>
            </h2>
        </div>

        <div>
            <a href="{{ route('show', $appointment->id) }}" method="GET">
                <x-button-normal>
                    No
                </x-button-normal>
            </a>
        </div>

        <div>
            <form action="{{ route('destroy', $appointment->id) }}" method="POST">
                @csrf
                <x-button-danger>
                    YES
                </x-button-danger>
            </form>
        </div>

        </div>
        
    </x-card-content-normal>

</x-app-layout>
