<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-green-400 to-blue-400">


    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="flex flex-row justify-center p-3">
            <div>{{ $logo }}</div>
        </div>
        {{ $slot }}
    </div>

</div>
