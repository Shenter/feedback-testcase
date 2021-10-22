<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">


                            Feedback successfully added!<br>

                            @if (RateLimiter::availableIn(sha1(\Illuminate\Support\Facades\Auth::user()->getAuthIdentifier()))>0)
                                You can submit feedback in {{\Carbon\Carbon::now()->addSeconds(RateLimiter::availableIn(sha1(\Illuminate\Support\Facades\Auth::user()->getAuthIdentifier())))->diffForHumans() }}
                            @else
                            <a href="{{route('feedback.post')}}">
                                <button class="p-1 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-lg focus:border-4 border-green-300">Add a new feedback</button>
                            </a>
                            @endif
                        </div>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
