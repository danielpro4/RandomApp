<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = Participant::all();

        return view('participants.index')->with(['participants' => $participants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('participants.form', [
            'participant' => new Participant()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:participants|max:65'
        ]);

        $participant = Participant::create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'birth' => $request->get('birth'),
            'xp' => $request->get('xp'),
        ]);

        return redirect()
            ->route('participants.all')
            ->with('success', "Participante {$participant->firstname} registrado correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function view(Participant $participant)
    {
        return view('participants.view', [
            'participant'  => $participant,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        return view('participants.form', [
            'participant' => $participant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $participantId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $participantId)
    {
        $participant = Participant::findOrFail($participantId);

        $participant->fill(array_only($request->all(), $participant->getFillable()))->save();

        return redirect()->route('participant.view', $participant)
            ->with('participant', $participant)
            ->with('success', 'Participant was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {

        $participant->delete();

        return redirect()
            ->route('participants.all')
            ->with('success', 'Participant was deleted successfully');
    }
}
