<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function createUser(Request $request){
        $request -> validate(
            [
            'name'=>'required',
            'email'=>'required|email|max:50',
            'password'=>'required',
            ]
            );
            $newUser = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
            ]);
            $newUser = User::find($newUser->id);
            if($newUser) {
                return response ([
                    'message'=>'success',
                    'name'=> $newUser
                ]);
            }else{
                return response([
                    'message'=> 'success',
                    'name'=> 'user  not created'
                ]);
            };
    }
    function readOneUser(Request $request){
        $request->validate([
            'id'=> 'required'
        ]);
        $findUser = User::find($request->id);
        if($findUser){
            return response ([
                'message'=>'success',
                'tasks'=> $findUser
            ]);
        }else{
            return response([
                'message' => 'failed',
                'tasks'=> 'this user does not exist'
            ]);
        }
    }
    function readAllUsers() {
        $allUsers = User::all();
        //checks whether the tasks exist or not
        if($allUsers){
            //response is taken as an array
            return response ([
                'message'=>'Success',
                'tasks'=> $allUsers

            ]);
        }else{
            return response([
                'message' => 'failed',
                'tasks'=> 'no Subcounty available'
            ]);
        }
    }
}
