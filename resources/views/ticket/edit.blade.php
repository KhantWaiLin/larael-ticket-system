<x-app-layout>
    <div class="w-screen flex flex-col justify-center items-center" style="height: calc(100vh - 4em)">
        <h1 class="flex justify-center items-center">Create a new support ticket</h1>
        <form method="post" action="{{route('ticket.update',$ticket)}}" class="w-[20em] mt-2 bg-gray-200 p-5 rounded-lg" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-2">
                <x-input-label for="title" value="Title" />
                <x-text-input class="w-full mt-1" id="title" name="title" type="text" placeholder="title" value="{{$ticket->title}}" autofocus autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div class="mb-2">
                <x-input-label for="description" value="Description" />
                <x-text-area placeholder="Add description" name="description" id="description" class="w-full mt-1" value="{{$ticket->description}}" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
            <div>
                @if($ticket->attachment)
                <img src="{{"/storage/".$ticket->attachment}}" />
                @endif
                <x-input-label for="attachment" value="Attachment" class="mb-3" />
                <x-file-input type="file" name="attachment" class="w-full " />
                <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
            </div>
            <div class="mt-5 w-full flex justify-end items-end">
                <x-primary-button>Update</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>