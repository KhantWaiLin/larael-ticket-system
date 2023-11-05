<x-app-layout>
    <div class="w-screen flex flex-col justify-center items-center" style="height: calc(100vh - 4em)">
        <h1 class="flex justify-center items-center">Create a new support ticket</h1>
        <form method="post" action="{{route('ticket.store')}}" class="w-[20em] mt-2 bg-gray-200 p-5 rounded-lg">
            @csrf
            @method('post')
            <div>
                <x-input-label for="title" value="Title" />
                <x-text-input id="title" name="title" type="text" value="" required autofocus autocomplete="title" class=" mt-1 mb-3 block w-full resize-none rounded-lg border-0 focus:border-5 border-indigo-400" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div>
                <x-input-label for="description" value="Description" />
                <textarea name="description" id="description" class="w-full mt-1 mb-3 resize-none rounded-lg border-0 focus:border-5 border-indigo-400">

                </textarea>
            </div>
            <div>
                <x-input-label for="attachment" value="Attachment" class="mb-3" />
                <input type="file" name="attachment" class="w-full" />
            </div>
            <div class="mt-5 w-full flex justify-end items-end">
                <x-primary-button>Create</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>