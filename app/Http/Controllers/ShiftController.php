<?php

namespace App\Http\Controllers;

use App\Shift;
use App\Http\Requests\ShiftRequest;

class ShiftController extends Controller
{
    public function index()
    {
        return response()->json(Shift::where('house_id',auth()->user()->house_id)->get());
    }

    public function show(Shift $shift){
        return response()->json($shift);
    }

    public function store(ShiftRequest $request)
    {
        $shift = Shift::create(['house_id'=>auth()->user()->house_id,'name'=>$request->name,'start'=>$request->start,'end'=>$request->end,'duration'=>$request->duration]);
        return response()->json($shift);
    }

    public function update(ShiftRequest $request, Shift $shift)
    {
        if($shift->house_id === auth()->user()->house_id){
            $shift->update(['name'=>$request->name,'start'=>$request->start,'end'=>$request->end,'duration'=>$request->duration]);
            return response()->json($shift);
        }else{
            return null;
        }
    }

    public function destroy(Shift $shift)
    {
        if($shift->house_id === auth()->user()->house_id){
            $shift->delete();
        }else{
            return null;
        }
    }
}
