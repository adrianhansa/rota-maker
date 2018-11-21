<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Day;
use App\House;
use App\Employee;
use App\Shift;

class DayController extends Controller
{
    public function getGenericShifts(House $house)
    {
        $shifts = Shift::where('house_id',$house->id)->get();
        return response()->json($shifts);
    }

    public function daysSelected($house,$start,$end)
    {
        $house = House::where('company_id',auth()->user()->company_id)->where('slug',$house)->first();
        $dates = [];
        $shifts = [];
        $start = $start + 86400;
        $end = $end + 86400;
        do{
            $dt = Carbon::parse(date("Y-m-d",$start));
            $dates[] = ['date'=>date("Y-m-d",$start),'dayOfWeek'=>$dt->englishDayOfWeek,'monthName'=>$dt->englishMonth,'year'=>$dt->year,'month'=>$dt->month];
            $start += 86400;
        }while($start <= $end);
        foreach($dates as $date){
            //check if these dates exist in the Days table.
            $existingDates = Day::where('house_id',$house->id)->get()->pluck('date')->toArray();
            if(!in_array($date['date'],$existingDates)){
                Day::create(['house_id'=>$house->id,'date'=>$date['date']]);
            }else{
                //get existing shifts
                $day = Day::where('house_id',$house->id)->where('date',$date['date'])->first();
                foreach($day->employees as $employee){
                    $shifts[] = $employee->pivot;
                }
            }
        }
        return response()->json(['days'=>$dates,'shifts'=>$shifts]);
    }

    public function existingShifts()
    {
        $days = request()->days;
        $house = House::where('company_id',auth()->user()->company_id)->where('slug',request()->house)->first();
        $shifts = [];
        foreach($days as $day){
             $day = Day::where('house_id',$house->id)->where('date',$day['date'])->first();
             foreach($day->employees as $employee){
                 $shifts[] = $employee->pivot;
             }
        }
        return response()->json($shifts);
    }

    public function createShift()
    {
        $staff = request()->employee;
        $date = request()->date;
        $shift = request()->shift;
        $employee = Employee::find($staff['id']);
        $day = Day::where('house_id',$staff['house_id'])->where('date',$date['date'])->first();
        $day->employees()->syncWithoutDetaching([$employee->id=>['shift_id'=>$shift['id'],'date'=>$date['date'],'shift_name'=>$shift['name'],'shift_duration'=>$shift['duration']]]);
    }
}