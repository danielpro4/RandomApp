<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{
    /**
     * Validation rules for the record.
     *
     * @var string[]
     */
    protected $validationRules = [
        'firstname' => 'required|max:35',
        //'lastname' => 'required|max:35',
        //'email' => 'required|unique:participants|max:35'
    ];

    /**
     * Gets an array with all users in the system.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {

        $participants = Participant::orderBy('created_at', 'DESC')->get();

        return response()->json(['participants' => $participants], 200);
    }

    /**
     * Creates a new user from data specified in the para $request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return response()->json(['participant' => null, 'errors' => $validator->errors()], 400);
        }

        $participant = Participant::create([
            'firstname' => $request->get('firstname'),
            'lastname' => '-',
            'email' => strtolower($request->get('email')),
            'user_id' =>$request->get('user_id')
        ]);

        return response()->json(['participant' => $participant, 'message' => 'Participant was created successfully.'], 200);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {

        $participant = Participant::findOrFail($id);

        $participant->delete();

        return response()->json(['participant' => $participant, 'message' => 'Participant was deleted successfully.'], 200);
    }
}
