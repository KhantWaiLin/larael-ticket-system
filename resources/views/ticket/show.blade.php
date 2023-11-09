<x-app-layout>
    <h1>{{$ticket->title}}</h1>
    <p>{{$ticket->description}}</p>
    @if($ticket->attachment)
    <a href="{{"/storage/".$ticket->attachment}}" target="_blank">Attachment</a>
    @endif
    <p>Created by {{$user->name}}</p>
    <span>{{$ticket->created_at}}</span>

    <div class="flex gap-3">
        <a href="{{route('ticket.edit',$ticket)}}">
            <x-primary-button>Edit</x-primary-button>
        </a>
        <form action="{{route('ticket.destroy',$ticket)}}" method="post">
            @csrf
            @method('delete')
            <x-primary-button>Delete</x-primary-button>
        </form>

        @if(auth()->user()->isAdmin)
        <form action="{{route('ticket.update',$ticket)}}" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="status" value="approved" />
            <x-primary-button>Approve</x-primary-button>
        </form>
        <form action="{{route('ticket.update',$ticket)}}" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="status" value="rejected" />
            <x-primary-button>Reject</x-primary-button>
        </form>

        @else
        <p>Status:{{$ticket->status}}</p>
        @endif
    </div>

</x-app-layout>