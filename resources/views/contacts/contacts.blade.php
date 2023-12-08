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
        <script>
            alert("Contact added successfully!");
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if($contacts->count() > 0)
            @foreach($contacts as $contact)

            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; position:relative;">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <strong>Name: </strong>{{ $contact->name }}<br>
                        <strong>Email: </strong>{{ $contact->email }}<br>
                        <strong>Contact: </strong>{{ $contact->contact }}<br>
                        <strong>Address: </strong>{{ $contact->address }}<br>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary" style="position: absolute; top: 50%; transform: translateY(-50%); right: 20px; padding: 5px; border: 1px solid #ccc; border-radius: 5px">Edit Contact</a>
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

        <a  href="contacts/create">
            <div style="margin:auto; width: 50%;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div style="text-align:center;" class="p-6 text-gray-900 dark:text-gray-100">
                   Click here to add a new contact.
                </div>
            </div>
        </a>
        </div>
    </div>

</x-app-layout>



