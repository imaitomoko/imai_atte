<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;

class RestController extends Controller
{
    public function restStart(){
        $work = Work::latest()->first();
    
        Rest::create([
            'work_id' => $work->id,
            'start_break' => Carbon::now()->toTimeString(),
        ]);
        return view('index');
    }

    public function restEnd(){
         $work = Work::latest()->first();
            $timeout = Rest::where('work_id', $work->id)->latest()->first();
            $timeout->update([
            'end_break' => Carbon::now()->toTimeString(),
            ]);
            return view('index');
    }
    //
}
