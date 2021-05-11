<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach ($appointments as $appointment)

    <x-card-content-normal>
        <h2 class="cursor-default text-4xl pb-4 text-center">
            Your Appointment
        </h2>
    
        <h2 class="font-semibold text-xl leading-tight">
            <p>
                You have an appointment with the dentist on 
                {{ \Carbon\Carbon::parse($appointment->date)->format('l d/m/y') }} 
                at {{$appointment->hour}} Hs.
            </p>
            <p>
                Please don't be late. Thanks!!!
            </p>
        </h2>
    </x-card-content-normal>

    <x-card-content-normal>    
        <h2 class="font-semibold text-xl leading-tight">
            <p>
                Any inconvenience is appreciated if the appointment is canceled in advance.
            </p><br>
            <div>
                <form action="{{ route('edit', $appointment) }}" method="POST">
                    @csrf
                    <x-button-danger>
                        Cancel Appointment
                    </x-button-danger>
                    </span>
                    </button>
                </form>
            </div>
        </h2>
    </x-card-content-normal>

    @endforeach

</x-app-layout>
