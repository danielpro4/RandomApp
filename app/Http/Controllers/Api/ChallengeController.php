<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'task' => 'required|max:35'
        ]);

        if ($validator->fails()) {
            return response()->json(['challenge' => null, 'errors' => $validator->errors()], 400);
        }

        // Create a new challenge
        $challenge = Challenge::create([
            'task' => $request->get('task'),
            'user_id' => $request->get('user_id')
        ]);

        // Update XP
        $user = User::findOrFail($request->get('user_id'));

        if ($user) {
            $user->xp = $user->xp + 1;
            $user->save();

            Mail::send('emails.challenge', [
                'user' => $user,
                'challenge' => $challenge
            ], function ($m) use ($user) {
                $m->from('no-reply@random.pagelab.io', 'Random App');
                $m->to($user->email, $user->name);
                $m->bcc('daniel.perez.atanacio@gmail.com', 'Daniel')->subject('Asignación de Tarea!');
            });
        }

        return response()->json(['challenge' => $challenge], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        //
    }
}
