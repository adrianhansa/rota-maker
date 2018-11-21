<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('company_id',auth()->user()->company_id)->get();
        return response()->json($users);
    }

    public function store(UserRequest $request)
    {
    	$user = User::create([
			'name'=>$request->name,
			'email'=>$request->email,
			'admin'=>$request->admin,
			'house_id'=>$request->house['id'],
            'house_slug'=>str_slug($request->house['slug']),
			'password'=>Hash::make(strtolower($request->name)),
			'company_id'=>auth()->user()->company_id,
    	]);
    	return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        if(auth()->user()->company_id === $user->company_id){
            if($user->email === $request->email){
                $user->update(['name'=>$request->name,'admin'=>$request->admin,'email'=>$request->email]);
            }   
        }else{
            return null;
        }
    	
    }

    public function show(User $user)
    {
    	return response()->json($user);
    }

    public function delete(User $user)
    {
    	if($user->company_id === auth()->user()->company_id){
    		$user->delete();
    	}
    }
}
