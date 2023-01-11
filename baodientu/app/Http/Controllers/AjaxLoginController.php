<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\baiviet;
use App\Models\User;
use App\Models\comment;
use Mail;




class AjaxLoginController extends Controller
{
     public function login(Request $request){
        //  $validator = validator::make($request->all(),
        //  [
        //      'email' => 'required|email|exists:customer',
        //      'password' => 'required'
        //  ]);
        //  if($validator->passes()){
        //      return response()->json(['error'=>$validator->errors()->all()]);
        //      $data = $request->only('email','password');
        //      $check_login = Auth::check()->attemp($data);
        //      if(check_login){
                
        //      }
        //  }
        //  return response()->json(['error'=>$validator->errors()->all()]);
     }

    public function comment(Request $request, $baiviet_id){
        $user_id = Auth::user()->id;
        $validator = Validator::make($request->all(),[
             'content' => 'required'
         ],[
            'content.required' => 'Nội dung không được để trống'
         ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->first()]);
        }
        $data = [
            'user_id' => $user_id,
            'baiviet_id' => $baiviet_id,
            'content' => $request->content
            ]; 
            if($comment = comment::create($data)){
                $comments = comment::where(['baiviet_id' => $baiviet_id, 'reply_id' => 0])->get();
                // return response()->json(['comments'=>$comments]);
                return view('dscomment',compact('comments'));
            }
    }
}
    