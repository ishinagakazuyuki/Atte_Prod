<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\attendance;
use App\Models\breaktime;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function stamp(Request $request){
        $users = Auth::user();
        $date = date('Y/m/d');
        $wstarton = 'disabled';
        $wendon = 'disabled';
        $bstarton = 'disabled';
        $bendon = 'disabled';
        $works = attendance::User_idSearch($users->id)->DateSearch($date)->first();
        if(empty($works)){
            $wstarton = '';
        }else{
            $worke = attendance::User_idSearch($users->id)->DateSearch($date)->where('work_end_time', '=', null)->first();
            if(!empty($worke)){
                $wendon = '';
                $breake = breaktime::where('attendance_id', '=',  $works['id'])->where('break_end_time', '=', null)->first();
                if(!empty($breake)){
                    $bendon = '';
                }else{
                    $bstarton = '';
                }
            }
        }
        return view('stamp', compact('users','wstarton','wendon','bstarton','bendon'));
    }
}
