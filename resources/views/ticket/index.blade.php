<x-app-layout>
    <div>
        <h1>Tickets List</h1>
        @forelse($tickets as $ticket)
        <div class="flex gap-5 py-2">
            <a href="{{route('ticket.show',$ticket->id)}}">{{$ticket->title}}</a>
            <p>{{$ticket->created_at->diffForHumans()}}</p>
        </div>
        @empty
        <p>There is no tickets</p>
        @endforelse

    </div>
</x-app-layout>