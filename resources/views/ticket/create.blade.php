<x-app-layout>
    <div class="w-screen flex flex-col justify-center items-center" style="height: calc(100vh - 4em)">
        <h1 class="flex justify-center items-center">Create a new support ticket</h1>
        <form method="post" action="{{route('ticket.store')}}" class="w-[20em] mt-2 bg-gray-200 p-5 rounded-lg">
            @csrf
            @method('post')
            <div class="mb-2">
                <x-input-label for="title" value="Title" />
                <x-text-input class="w-full mt-1" id="title" name="title" type="text" placeholder="title" value="" autofocus autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div class="mb-2">
                <x-input-label for="description" value="Description" />
                <x-text-area placeholder="Add description" name="description" id="description" class="w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
            <div>
                <x-input-label for="attachment" value="Attachment" class="mb-3" />
                <x-file-input type="file" name="attachment" class="w-full " />
                <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
            </div>
            <div class="mt-5 w-full flex justify-end items-end">
                <x-primary-button>Create</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>