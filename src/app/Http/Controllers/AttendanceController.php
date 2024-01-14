<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class AttendanceController extends Controller
{
    public function attendanceStart(){
        $attendanceStart = now();
        Work::create([
            'work_date' => $attendanceStart->toDateString(),
            'start_work' => $attendanceStart->toTimeString(),
        ]);
        return redirect ('index');
    }
    //
}
