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
                <x-text-input id="contact" name="contact" type="tel" pattern="\(\d{3}\)-\d{3}-\d{4}" class="mt-1 block w-full" value="{{ $contact->contact }}" required autofocus autocomplete="contact" />

                    <script>
        document.getElementById('contact').addEventListener('input', function (e) {
            let inputValue = e.target.value.replace(/\D/g, '');

            if (e.inputType === 'deleteContentBackward') {
                if (/[\-\)]/.test(e.target.value.slice(-1))) {
                    inputValue = inputValue.slice(0, -1);
                }
            }

            if (inputValue.length > 10) {
                inputValue = inputValue.slice(0, 10);
            }

            if (inputValue.length >= 6) {
                inputValue = '(' + inputValue.slice(0, 3) + ')-' + inputValue.slice(3, 6) + '-' + inputValue.slice(6);
            } else if (inputValue.length >= 3) {
                inputValue = '(' + inputValue.slice(0, 3) + ')-' + inputValue.slice(3);
            }

            e.target.value = inputValue;
        });
                    </script>
                <x-input-error class="mt-2" :messages="$errors->get('contact')" />
                    </div>
<br>
                    <div id="autocomplete-container" class="relative">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="addressInput" name="address" type="text" class="mt-1 block w-full" value="{{ $contact->address }}" required autofocus autocomplete="address" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div id="autocomplete-suggestions" class="absolute z-10 mt-2 bg-white border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-md overflow-hidden" style="display: none; color: white;"></div>

<br>
                    <x-primary-button type="submit">Save Changes</x-primary-button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addressInput = document.getElementById("addressInput");
        const suggestionsContainer = document.getElementById("autocomplete-suggestions");

        addressInput.addEventListener("input", function () {
            const query = this.value.trim();

            const apiURL = `https://api.geoapify.com/v1/geocode/autocomplete?apiKey=87e06a2aa94647c1afd81a6f457a28e1&text=${encodeURIComponent(query)}`;
            console.log(apiURL);

            if (query.length > 2) {
                fetch(apiURL)
                    .then(response => response.json())
                    .then(data => {
                        displaySuggestions(data.features);
                    })
                    .catch(error => console.error('Error fetching autocomplete suggestions:', error));
            } else {
                hideSuggestions();
            }
        });

        function displaySuggestions(suggestions) {
            suggestionsContainer.innerHTML = "";

            if (suggestions && suggestions.length > 0) {
                suggestions.forEach(suggestion => {
                    const suggestionItem = document.createElement("div");
                    suggestionItem.className = "p-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600";
                    suggestionItem.textContent = suggestion.properties.formatted;

                    suggestionItem.addEventListener("click", function () {
                        addressInput.value = suggestion.properties.formatted;
                        hideSuggestions();
                    });

                    suggestionsContainer.appendChild(suggestionItem);
                });

                suggestionsContainer.style.display = "block";
            } else {
                hideSuggestions();
            }
        }

        function hideSuggestions() {
            suggestionsContainer.style.display = "none";
        }

        document.addEventListener("click", function (event) {
            if (!event.target.closest("#autocomplete-suggestions") && !event.target.closest("#addressInput")) {
                hideSuggestions();
            }
        });
    });
</script>