<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Company;
use App\User;

class CompanyController extends Controller
{
    public function store(CompanyRequest $request)
    {
    	$company = Company::create([
    		'user_id'=>auth()->user()->id,
    		'name'=>$request->name,
    		'address'=>$request->address
    	]);

        $user = User::find(auth()->id());
        $user->company_id = $company->id;
        $user->save();
    }

    public function update(CompanyRequest $request, Company $company)
    {
    	if($company->user_id === auth()->user()->id){
    		$company->update(['name'=>$request->name,'address'=>$request->address]);
    	}else{
    		return null;
    	}
    }

    public function details()
    {
    	$company = Company::find(auth()->user()->company_id);
    	return response()->json($company);
    }

    public function delete($id){
    	$company = Company::find($id);
    	if(auth()->id() === $company->user_id){
    		$company->delete();
    	}else{
    		return null;
    	}
    }
}
