<x-app-layout>
    <h1>{{$ticket->title}}</h1>
    <p>{{$ticket->description}}</p>
    @if($ticket->attachment)
    <a href="{{"/storage/".$ticket->attachment}}" target="_blank">Attachment</a>
    @endif
    <p>Created by {{$user->name}}</p>
    <span>{{$ticket->created_at}}</span>

</x-app-layout>