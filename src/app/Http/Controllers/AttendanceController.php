<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;

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

    public function getBefore()
    {
        $date = Carbon::parse()->subDay()->toDateString();

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

    public function getAfter()
    {
        $date = Carbon::now()->addDay()->toDateString();

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
}