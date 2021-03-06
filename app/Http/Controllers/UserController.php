<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use App\Models\vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'unique:users|required',
            'email' => 'unique:users|required|email',
            'password' => 'required',
        ];

        $input     = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user     = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        //$token = $request->name->createToken('accessToken');
        return response()->json(['success' => true, 'message' => 'user has registered successfully.', "data"=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $input     = $request->only('email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }


        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            // $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $token = $user->createToken('accessToken', ['admin']);

                 if($user->email == "admin@msaadaapp.com"){
                     return response()->json(['success' => true, 'userType'=>'admin' ,'userdetails'=>$user,'token'=>$token],200);
                 }else{
                     return response()->json(['success' => true, 'userType'=>'other', 'userdetails'=>$user,'token'=>$token],200);
                 }

         }
         else{
             return response()->json(['success'=>false,'error'=>'wrong login credentials' ], 200);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allVotes(){
        $votes = vote::all();
        return response()->json(['success' => true, 'response' => $votes]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add(Request $request){


        $rules = [
            'question' => 'required',
            'A' => 'required',
            'B' => 'required',
            'C' => '',
            'D' => '',
        ];

        $input     = $request->only('question','A','B','C','D');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        //$data = Question::create(['question'=>$request->question, 'a'=>$request->a,
        //  'b'=>$request->b, 'c'=>$request->c, 'd'=>$request->d]);

        $data = new Question();
        $data->question = $request->question;
        $data->A = $request->A;
        $data->B = $request->B;
        $data->save();

        return response()->json(['response'=>$data]);
    }
}
