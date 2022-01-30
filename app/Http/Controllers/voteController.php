<?php

namespace App\Http\Controllers;

use App\Models\vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class voteController extends Controller
{
    public function Voting(Request $request){
        $rules = [
            'voter' => 'required',
            'question' => 'required',
            'answer' => 'required',

        ];

        $input     = $request->only('voter','question','answer');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $data = vote::create([
            'voter'=>$request->voter,
            'question'=>$request->question,
            'answer'=>$request->answer,
        ]);
        return response()->json(['success' => true, 'response' => $data]);
    }

    public function allVotes(){
        $votes = vote::all();
        return response()->json(['success' => true, 'response' => $votes]);
    }
}
