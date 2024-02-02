<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;

class AttendanceController extends Controller
{
   

    public function attendanceStart(){
        $user = Auth::user();
       
        Work::create([
            'user_id' => $user->id,
            'work_date' => Carbon::now()->toDateString(),
            'start_work' => Carbon::now()->toTimeString(),
          ]);

          

        return view('index');
    }

    public function attendanceEnd(){
        $user = Auth::user();

            $timeout = Work::where('user_id', $user->id)->latest()->first();
            $timeout->update([
            'end_work' => Carbon::now()->toTimeString(),
        ]);

        return view('index');
    }

    public function show(){
        return view('datetable', ['date' => '']);
    }
    
    public function result(Request $request){
        
        $date = $request->input('date');
        $user = auth()->user();
        $items = Work::with('user')->where('user_id', $user->id)->whereDate('work_date', $date)->paginate(5);
        $rests =  Rest::where('created_at', $date)->paginate(5);
        return view('datetable', ['items' => $items]);

    }


    //
}
