<div>
    <div class="col-span-full">
        <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Message</label>
        <div class="mt-2">
            <textarea wire:model="message" rows="6" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

            </textarea>
        </div>
        <p class="mt-3 text-sm leading-6 text-gray-600">Write the message to be sent to members.</p>
    </div>

    <button
        wire:click="sendSMS"
        class="mt-6 w-full rounded-md border border-transparent bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-500">
        Send SMS
    </button>
    <div wire:loading class="mt-4 " >
        <p class="items-center text-emerald-500">
            Sending...
        </p>
    </div>
</div>
