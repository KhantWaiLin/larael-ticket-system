<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketUpdateNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tickets = Ticket::all();
        $user = auth()->user();
        //Ticket::latest()->get()
        $tickets = $user->isAdmin ? Ticket::orderBy('created_at', 'desc')->get() : $user->tickets;
        // return view('ticket.index', ['tickets' => $tickets]);
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        if ($request->file('attachment')) {
            $this->storeAttachment($request, $ticket);
        }

        return redirect(route('ticket.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // dd($ticket);
        $user = User::find($ticket->user_id);
        return view('ticket.show', compact('ticket', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->except('attachment'));
        if ($request->has('status')) {
            // $user = User::find($ticket->user_id);
            $ticket->user->notify(new TicketUpdateNotification($ticket));
            // return (new TicketUpdateNotification($ticket))->toMail($user);
        }
        if ($request->file('attachment')) {
            Storage::disk('public')->delete($ticket->attachment);
            $this->storeAttachment($request, $ticket);
        }
        return redirect(route('ticket.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }

    protected function storeAttachment($request, $ticket)
    {
        $ext = $request->file('attachment')->extension();
        $contents = file_get_contents($request->file('attachment'));
        $filename = Str::random();
        $path = "attachments/.$filename.$ext";
        Storage::disk('public')->put($path, $contents);
        $ticket->update(['attachment' => $path]);
    }
}
