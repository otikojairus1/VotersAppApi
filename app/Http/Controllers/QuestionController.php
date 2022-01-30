<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
class QuestionController extends Controller
{
    public function add(Request $request){


        $rules = [
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => '',
            'd' => '',
        ];

        $input     = $request->only('question','a','b','c','d');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $data = Question::create(['question'=>$request->question, 'a'=>$request->a,
            'b'=>$request->b, 'c'=>$request->c, 'd'=>$request->d]);

        return response()->json(['response'=>$data]);
    }

    public function all(){
        $data = Question::all();
        return response()->json(['response'=>$data]);
    }
}
