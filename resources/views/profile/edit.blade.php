<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           {{ __('Profile') }}
       </h2>
   </x-slot>

   <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

       <div class="flex justify-between items-center">
           <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg" id="profileForm" style="width: 100%;" >
               <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
                <x-primary-button id="generateQrCode" class="mt-4 px-4 py-2 bg-white text-black rounded-md">Generate QR Code</x-primary-button>
               </div>
           </div>
       </div>

       <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg" id="qrBox" style="display: none;">
            <div class="max-w-xl">
                <div style="text-align: center;">
                    <canvas id="qrCodeContainer" class="mt-4"></canvas><br>
                </div>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400" style="text-align: left;">
                            {{ __("Share your contact details using this QR Code.") }}
                        </p>
            </div>
        </div>

       <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
           <div class="max-w-xl">
               @include('profile.partials.update-password-form')
           </div>
       </div>

       <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
           <div class="max-w-xl">
               @include('profile.partials.delete-user-form')
           </div>
       </div>
     </div>
    </div>
</x-app-layout>
