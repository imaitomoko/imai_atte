<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;

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

    public function result(){
        $date = Carbon::now()->toDateString();
        $user = auth()->user();

        $items = Work::whereDate('works.work_date', $date)
        ->join('users', 'works.user_id', '=', 'users.id')
        ->join('rests', 'works.id', '=', 'rests.work_id')
        ->select('works.id', 'users.name', 'works.start_work', 'works.end_work', DB::raw('SUM(TIMESTAMPDIFF(SECOND, rests.start_break, rests.end_break)) AS total_break_duration'))
        ->groupBy('works.id', 'users.name','works.start_work', 'works.end_work')
        ->Paginate(5);

        return view('datetable', ['items'=> $items,'date'=> $date]);
    }


    public function getBefore(Request $request)
    {
        $date = Carbon::parse($request->get('before'));
        $date = $date->subDay()->toDateString();

        $items = Work::with(['user','rests'])
        ->whereDate('work_date', $date)
        ->Paginate(5);
        $totalBreakTime = 0;

        foreach ($items as $item) {
            foreach ($item->rests as $rest) {
            $work = $rest->work;
                if($work) {
                $startTime = Carbon::parse($rest->start_break);
                $endTime = Carbon::parse($rest->end_break);
                $breakDuration = $endTime->diffInMinutes($startTime);
                $totalBreakTime += $breakDuration;
                }
            }
        }
        return view('datetable', ['items'=> $items,'date'=> $date, 'totalBreakTime' => $totalBreakTime]);
    }

    public function getAfter(Request $request)
    {
        $date = Carbon::parse($request->get('after'));
        $date = $date->addDay()->toDateString();

        $items = Work::with(['user','rests'])
        ->whereDate('work_date', $date)
        ->Paginate(5);
        $totalBreakTime = 0;

        foreach ($items as $item) {
            foreach ($item->rests as $rest) {
            $work = $rest->work;
                if($work) {
                $startTime = Carbon::parse($rest->start_break);
                $endTime = Carbon::parse($rest->end_break);
                $breakDuration = $endTime->diff($startTime)->format('%h:%I:%S');
                $totalBreakTime += $breakDuration;
                }
            }
        }

        return view('datetable', ['items'=> $items,'date'=> $date, 'totalBreakTime' => $totalBreakTime]);
    }
}