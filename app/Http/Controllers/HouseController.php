<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Http\Requests\HouseRequest;

class HouseController extends Controller
{
    public function index()
    {
    	$houses = House::where('company_id',auth()->user()->company->id)->orderBy('name','asc')->get();
    	return response()->json($houses);
    }

    public function show(House $house)
    {
    	return response()->json($house);
    }

    public function store(HouseRequest $request)
    {
    	if(auth()->user()->company_id){
    		$house = House::create(['company_id'=>auth()->user()->company_id,'name'=>$request->name,'slug'=>str_slug($request->name),'address'=>$request->address]);
    		return response()->json($house);
    	}else{
    		return null;
    	}
    }

    public function update(HouseRequest $request, House $house)
    {
    	if(auth()->user()->company_id){
    		$house->update(['name'=>$request->name,'slug'=>str_slug($request->name),'address'=>$request->address]);
    		return response()->json($house);
    	}else{
    		return null;
    	}
    }

    public function delete($id)
    {
		$house = House::find($id);
		if(auth()->user()->company_id === $house->company_id){
			$house->delete();
		}else{
			return null;
		}
    }

    public function restore(House $house)
    {

    }

    public function forceDelete(House $house)
    {

    }
}
