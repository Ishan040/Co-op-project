<section class="space-y-6">

    <x-danger-button
        x-data=""
        x-on:click="$dispatch('open-modal', 'confirm-contact-deletion')"
        style="position: absolute; top: 49px; transform: translateY(50%); right: 30px;"
    >{{ __('Delete Contact') }}</x-danger-button>

    <x-modal name="confirm-contact-deletion" :show="$errors->contactDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('contacts.destroy', $contact->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this contact?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once this contact is deleted, it will be permanently removed. Please confirm to proceed.') }}
            </p>

            <div class="mt-6">
                <input type="hidden" name="contact_id" value="{{ $contact->id }}">

                <p class="mt-2">{{ __('Contact Information')  }}:</p>
                <strong>Name: </strong>{{ $contact->name }}<br>
                <strong>Email: </strong>{{ $contact->email }}<br>
                <strong>Contact: </strong>{{ $contact->contact }}<br>
                <strong>Address: </strong>{{ $contact->address }}<br>
            </div>

            <div class="mt-6 flex justify-end">

                <x-secondary-button
                x-ref="cancelButton"
                x-on:click="
                $dispatch('close');
                $refs.cancelButton.focus();
                ">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Contact') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
