<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('admin') }}
      </h2>
  </x-slot>

  @foreach ($appointments as $appointment)
    <x-card-content-normal>
      <div class="border-b-2 border-gray-800 text-left text-xl text-yellow-200">
        {{ \Carbon\Carbon::parse($appointment->date)->format('l d/m/y') }} - {{ $appointment->hour }} Hs. - {{ $appointment->user->name }}
      </div>
      <div class="text-left">
        <b>Treatment:</b> {{ $appointment->treatment }}
      </div>
      <div class="flex flex-row-reverse gap-2">   
        <form action="{{ route('edit', $appointment) }}" method="POST">
          @csrf
          <button type="submit" title="delete">
            <x-button-danger>
              Cancel Appointment
            </x-button-danger>
          </button>
        </form>
        <a href="mailto: {{ $appointment->user->email }}">
          <x-button-normal>
            Email
          </x-button-normal>
        </a>
      </div>
    </x-card-content-normal>
  @endforeach


  <div class="text-center p-2 mx-auto my-4 align-middle">
      <form action="/admin" method="GET">
        @csrf
        <input class="m-1" name="date" id="date" type="hidden" value="{{ $next5days }}">
        <x-button-golden>Next 5 Days >></x-button-golden>
    </form>
  </div>


</x-app-layout>
