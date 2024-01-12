<link rel="stylesheet" href="app1.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Contacts
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>

        @php
            $action = session('action');
        @endphp

        @if($action === 'add')
            <script>
                alert("Contact added successfully!");
            </script>
        @elseif($action === 'update')
            <script>
                alert("Contact updated successfully!");
            </script>
        @endif
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if($contacts->count() > 0)
            @foreach($contacts as $contact)

            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; position:relative;">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img class="h-48 w-full object-cover md:w-48" src="{{ asset('testing.jpg') }}" alt="man looking at items at a store">
                </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-white font-semibold">{{ $contact->name }}</div>
                        <p class="mt-2 text-gray-300">{{ $contact->email }}</p>
                        <p class="mt-2 text-gray-300">{{ $contact->contact }}</p>
                        <p class="mt-2 text-gray-300">{{ $contact->address }}</p>

                        <x-danger-button
                         x-data=""
                         x-on:click="$dispatch('open-modal', 'confirm-contact-deletion-{{ $contact->id }}')"
                         style="position: absolute; top: 49px; transform: translateY(50%); right: 30px;"
                         >{{__('Delete Contact') }}</x-danger-button>

                        <a href="{{ route('contacts.edit', $contact->id) }}">
                        <x-primary-button class="absolute top-15 transform -translate-y-50 right-10">Edit Contact</x-primary-button>                        <section class="space-y-6">   
                        </a>

                        <section class="space-y-6">
                        @include('contacts.delete-contact-form', ['contact' => $contact])
                        </section>
                    </div>
                </div>
                </div>
            @endforeach
        @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You do not have any contacts.
                </div>
            </div>
        @endif
    

    <br><br>

            <div style="margin:auto; width: 50%;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div style="text-align:center;" class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ url('contacts/create') }}" class="btn btn-primary text-gray-900 dark:text-gray-100">
                        Click here to add a new contact.
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>



