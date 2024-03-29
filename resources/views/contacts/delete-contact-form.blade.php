@props(['contact' => null])

<section class="space-y-6">

    <x-danger-button
        x-data=""
        x-on:click="$dispatch('open-modal', 'confirm-contact-deletion-{{ $contact->id }}')"
        style="position: absolute; top: 155.25px; transform: translateY(50%); right: 675px;"
    >{{ __('Delete Contact') }}</x-danger-button>

    <x-modal x-ref="confirmDeletionModal" name="confirm-contact-deletion-{{ $contact->id }}" :show="$errors->contactDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('contacts.destroy', $contact->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this contact?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once this contact is deleted, it will be permanently removed. Please confirm to proceed.') }}
            </p>

            <div class="mt-6" style="color: white;">
                <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                <p class="mt-2">{{ __('Contact Information')  }}:</p>
                <strong>Name: </strong>{{ $contact->name }}<br>
                <strong>Email: </strong>{{ $contact->email }}<br>
                <strong>Contact: </strong>{{ $contact->contact }}<br>
                <strong>Address: </strong>{{ $contact->address }}<br>
            </div>

            <div class="mt-6 flex justify-end">

            <a href="{{ url('/contacts') }}" class="btn btn-primary" style="padding: 3px; border: 1px solid #ccc; border-radius: 5px; color: white;">Cancel</a>

                <x-danger-button class="ms-3">
                    {{ __('Delete Contact') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
