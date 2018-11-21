<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\House;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
    	$employees = Employees::where('company_id',auth()->user()->company_id)->get();
    	return response()->json($employees);
    }

    public function employeesByHouse(House $house)
    {
    	$employees = Employee::where('house_id',$house->id)->get();
    	return response()->json($employees);
    }

    public function show(Employee $employee)
    {
    	return response()->json($employee);
    }

    public function store(EmployeeRequest $request)
    {
    	//$house = auth()->user()->house;// House::where('company_id',auth()->user()->company_id)->where('slug',$request->house_id)->first();
    	$employee = Employee::create([
    		'house_id'=>auth()->user()->house_id,
    		'name'=>$request->name,
    		'slug'=>str_slug($request->name),
    		'position'=>$request->position,
    		'contracted_hours'=>$request->contracted_hours,
    		'gender'=>$request->gender,
    		'medi_trained'=>$request->medi_trained,
    		'driver'=>$request->driver,
    		'can_run_shifts'=>$request->can_run_shifts
    	]);
    	return response()->json($employee);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
    	$employee->update([
            'name'=>$request->name,
            'slug'=>str_slug($request->name),
            'position'=>$request->position,
            'contracted_hours'=>$request->contracted_hours,
            'gender'=>$request->gender,
            'medi_trained'=>$request->medi_trained,
            'driver'=>$request->driver,
            'can_run_shifts'=>$request->can_run_shifts
        ]);
    }

    public function delete(Employee $employee)
    {
    	//$employee = Employee::find($id);
    	if($employee->house_id === auth()->user()->house_id){
    		$employee->delete();
    	}else{
    		return null;
    	}
    }

    public function restore(Employee $employee)
    {
    	
    }

    public function forceDelete(Employee $employee)
    {
    	
    }
}
