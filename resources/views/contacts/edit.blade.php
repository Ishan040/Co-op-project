<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 dark:text-gray-200 leading-tight">
            Edit Contact
        </h2>
    </x-slot>
<br>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800">
                <form method="post" action="{{ route('contacts.update', $contact->id) }}">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $contact->name }}" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
<br>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ $contact->email }}" required autofocus autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
<br>
                    <div>
                        <x-input-label for="contact" :value="__('Contact')" />
                        <x-text-input id="contact" name="contact" type="text" class="mt-1 block w-full" value="{{ $contact->contact }}" required autofocus autocomplete="contact" />
                        <x-input-error class="mt-2" :messages="$errors->get('contact')" />
                    </div>
<br>
                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" value="{{ $contact->address }}" required autofocus autocomplete="address" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
<br>
                    <x-primary-button type="submit">Save Changes</x-primary-button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>