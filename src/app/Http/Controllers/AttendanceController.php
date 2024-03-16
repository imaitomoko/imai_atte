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
        ->leftJoin('rests', 'works.id', '=', 'rests.work_id') //leftJoin（外部結合）でrests.work_idに値がなくてもwork.idを表示　  rightJoinでrests.work_idが基準
        ->select(
            'works.user_id', 
            'works.id as work_id', //asとは別名
            'users.name', 
            'works.start_work',
            'works.end_work', 
            DB::raw('TIMESTAMPDIFF(SECOND, works.start_work, works.end_work) AS work_duration'),
            DB::raw('SUM(TIMESTAMPDIFF(SECOND, rests.start_break, rests.end_break)) AS total_break_duration'))
        ->groupBy('works.user_id','works.id', 'users.name','works.start_work', 'works.end_work')
        ->Paginate(5);

        foreach ($items as $item) {
            $workDuration = $item->work_duration;
            $totalDuration = $item->total_break_duration;
            $result = $item->result;
            $result = $workDuration - $totalDuration;
            $item->total_break_duration = gmdate('H:i:s',$totalDuration);
            $item->result = gmdate('H:i:s',$result);
        }

        return view('datetable', ['items'=> $items,'date'=> $date]);
    }

    public function getBefore(Request $request)
    {
        $date = Carbon::parse($request->get('before'));
        $date = $date->subDay()->toDateString();

         $items = Work::whereDate('works.work_date', $date)
        ->join('users', 'works.user_id', '=', 'users.id')
        ->leftJoin('rests', 'works.id', '=', 'rests.work_id')
        ->select(
            'works.user_id', 
            'works.id as work_id', //asとは別名
            'users.name', 
            'works.start_work',
            'works.end_work', 
            DB::raw('TIMESTAMPDIFF(SECOND, works.start_work, works.end_work) AS work_duration'),
            DB::raw('SUM(TIMESTAMPDIFF(SECOND, rests.start_break, rests.end_break)) AS total_break_duration'))
        ->groupBy('works.user_id','works.id', 'users.name','works.start_work', 'works.end_work')
        ->Paginate(5);

        foreach ($items as $item) {
            $workDuration = $item->work_duration;
            $totalDuration = $item->total_break_duration;
            $result = $item->result;
            $result = $workDuration - $totalDuration;
            $item->total_break_duration = gmdate('H:i:s',$totalDuration);
            $item->result = gmdate('H:i:s',$result);
        }

        return view('datetable', ['items'=> $items,'date'=> $date]);
    }

    public function getAfter(Request $request)
    {
        $date = Carbon::parse($request->get('after'));
        $date = $date->addDay()->toDateString();

        $items = Work::whereDate('works.work_date', $date)
        ->join('users', 'works.user_id', '=', 'users.id')
        ->leftJoin('rests', 'works.id', '=', 'rests.work_id')
        ->select(
            'works.user_id', 
            'works.id as work_id', //asとは別名
            'users.name', 
            'works.start_work',
            'works.end_work', 
            DB::raw('TIMESTAMPDIFF(SECOND, works.start_work, works.end_work) AS work_duration'),
            DB::raw('SUM(TIMESTAMPDIFF(SECOND, rests.start_break, rests.end_break)) AS total_break_duration'))
        ->groupBy('works.user_id','works.id', 'users.name','works.start_work', 'works.end_work')
        ->Paginate(5);

        foreach ($items as $item) {
            $workDuration = $item->work_duration;
            $totalDuration = $item->total_break_duration;
            $result = $item->result;
            $result = $workDuration - $totalDuration;
            $item->total_break_duration = gmdate('H:i:s',$totalDuration);
            $item->result = gmdate('H:i:s',$result);
        }

        return view('datetable', ['items'=> $items,'date'=> $date]);
    }
}