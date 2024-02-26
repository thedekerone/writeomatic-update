@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">

            <!-- Steps indicator -->
            <div class="mb-5">
                <div class="flex space-x-2">
                    @php
                    $stepsNames = ["Details", "Title", "Intro", "Outline", "Content"];
                    @endphp

                    @foreach($stepsNames as $index => $name)
                    <button class="w-32 h-12 rounded-full flex items-center justify-center {{ $step === ($index + 1) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                        {{ $index + 1 }}. {{ $name }}
                    </button>
                    @endforeach
                </div>
            </div>

            @if($step === 1)
            <!-- Step 1 Content -->
            <div>
                {{-- ... content of step 1 ... --}}
            </div>
            @endif

            @if($step > 1 && $step < 5)
            <!-- Steps 2 to 5 Content -->
            <div>
                {{-- ... content of steps 2 to 5 ... --}}
            </div>
            @endif

            @if($step === 5)
            <!-- Step 5: Summary of the blog -->
            <div>
                {{-- ... content of step 5 ... --}}
            </div>
            @endif

            <!-- Buttons to navigate -->
            <div class="flex space-x-4 mt-4">
                <button class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600" {{ $step === 1 ? 'disabled' : '' }}>Back</button>
                <button class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full">Next</button>
            </div>

        </div>
    </div>
</div>

@endsection
