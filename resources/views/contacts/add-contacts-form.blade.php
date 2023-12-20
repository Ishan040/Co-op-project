<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Add new Contacts
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            You can add new contacts to your account by clicking the "Add New Contact" button.
        </p>
    </header>

    <form method="post" action="/contacts" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="contact" value="Contact" />
            <x-text-input id="contact" name="contact" type="text" class="mt-1 block w-full" autocomplete="contact" />
            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address" value="Address" />
            <x-text-input id="addressInput" name="address" type="text" class="mt-1 block w-full" autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div id="autocomplete-suggestions" class="absolute z-10 mt-2 bg-white border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-md overflow-hidden" style="display: none;"></div>

        <div class="flex items-center gap-4">
            <x-primary-button>Add New Contact</x-primary-button>

            @if (session('status') === 'contact-added')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >Contact Added.</p>
            @endif
        </div>
    </form>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addressInput = document.getElementById("addressInput");
        const suggestionsContainer = document.getElementById("autocomplete-suggestions");

        addressInput.addEventListener("input", function () {
            const query = this.value;

            if (query.length > 2) {
                fetch('https://api.geoapify.com/v1/geocode/autocomplete?apiKey=87e06a2aa94647c1afd81a6f457a28e1&q=${query}')
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

            if (suggestions.length > 0) {
                suggestions,forEach(suggestions => {
                    const suggestionItem = document.createElement("div");
                    suggestionItem.className = "p-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600";
                    suggestionItem.textContent = suggestion.properties.formatted;

                    suggestionItem.addEventListener("click", function () {
                        addressInput.value = suggestions.properties.formatted;
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
