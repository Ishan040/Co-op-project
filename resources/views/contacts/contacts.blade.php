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

            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>Name: {{ $contact->name }}</p>
                        <p>Email: {{ $contact->email }}</p>
                        <p>Contact: {{ $contact->contact }}</p>
                        <p>Address: {{ $contact->address }}</p>
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



