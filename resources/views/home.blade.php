<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Home
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                @if(session('last_viewed_contact'))
                    @php
                        $lastViewedContactId = session('last_viewed_contact');
                        $lastViewedContact = \App\Models\Contact::find($lastViewedContactId);
                    @endphp
                    <div class="max-w-md mx-auto bg-gray-700 rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
                        <div class="md:flex">
                            <div class="md:flex-shring-0">
                                <img class="h-48 w-full object-cover md:w-48" src="{{ asset('testing.jpg') }}" alt="man looking at item at a store">
                            </div>
                            <div class="p-8">
                                <div class="uppercase tracking-wide text-sm text-white font-semibold">{{ $lastViewedContact->name }}</div>
                                <p class="mt-2 text-gray-300">{{ $lastViewedContact->email }}</p>
                                <p class="mt-2 text-gray-300">{{ $lastViewedContact->contact }}</p>
                                <p class="mt-2 text-gray-300">{{ $lastViewedContact->address }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    

</x-app-layout>
