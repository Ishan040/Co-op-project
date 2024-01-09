<style>

    body {
        min-height: 950px;
        background-color: rgb(18, 24, 38);
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0px 2px 10px 2px rgba(0, 0, 0, 0.1);
        border-top: none;
        background-color: #fff;
        z-index: 99;
        top: auto;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        color: white !important;
    }

    .autocomplete-items div * {
        color: white;
    }

    .autocomplete-items div:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .autocomplete-items .autocomplete-active {
        background-color: rgba(0, 0, 0, 0.1);
    }


    .clear-button {
        color: rgba(0, 0, 0, 0.4);
        cursor: pointer;
        position: absolute;
        right: 5px;
        top: 0;
        height: 100%;
        display: none;
        align-items: center;
    }

    .clear-button.visible {
        display:flex;
    }

    .clear-button:hover {
        color: rgba(0, 0, 0, 0.6);
    }

</style>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Add or update your account's profile information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="contact" value="Contact" />
            <x-text-input id="contact" name="contact" type="tel" pattern="\(\d{3}\)-\d{3}-\d{4}" class="mt-1 block w-full" :value="$user->contact" />

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

        <div id="autocomplete-container" class="relative">
            <x-input-label for="address" value="Address" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="$user->address" autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div id="autocomplete-suggestions" class="absolute z-10 mt-2 bg-white border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-md overflow-hidden" style="display: none; color: white;"></div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addressInput = document.getElementById("address");
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


