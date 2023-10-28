<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\attendance;
use App\Models\breaktime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use DateTime;

class AttendanceController extends Controller
{
    public function wstart(Request $request){
        $users = Auth::user();
        $user_id = Auth::user()->only(['id']);
        $user_id = [
            'user_id' => $user_id['id']
        ];
        $wstart = date('Y/m/d H:i:s');
        $date = date('Y/m/d');
        $wstart = [
            'work_start_time' => $wstart
        ];
        $date = [
            'date' => $date
        ];
        $attendances = array_merge($user_id , $wstart , $date);
        attendance::create($attendances);
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

    public function wend(Request $request){
        $users = Auth::user();
        $user_id = Auth::user()->only(['id']);
        $wend = date('Y/m/d H:i:s');
        $wend = [
            'work_end_time' => $wend
        ];
        $wstart = attendance::where('work_end_time', '=',  null)->where('user_id', '=',  $user_id)->first()->only(['work_start_time']);
        $wend2 = new DateTime($wend['work_end_time']);
        $wstart2 = new DateTime($wstart['work_start_time']);
        $wtime = $wend2->diff($wstart2);
        $wtime = $wtime->format('%H:%I:%S');
        $wtime = [
            'work_time' => $wtime
        ];
        attendance::where('work_end_time', '=',  null)->where('user_id', '=',  $user_id)->first()->update([
            'work_end_time' => $wend['work_end_time'],
            'work_time' => $wtime['work_time']
        ]);
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

    public function bstart(Request $request){
        $users = Auth::user();
        $user_id = Auth::user()->only(['id']);
        $date = date('Y/m/d');
        $date = [
            'date' => $date
        ];
        $attendances = attendance::where('work_end_time', '=',  null)->User_idSearch($user_id)->get();
        $attendanceid = [
            'attendance_id' => $attendances['0']['id']
        ];
        $bstart = date('Y/m/d H:i:s');
        $bstart = [
            'break_start_time' => $bstart
        ];
        $breaks = array_merge($attendanceid , $bstart , $date);
        breaktime::create($breaks);
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

    public function bend(Request $request){
        $users = Auth::user();
        $user_id = Auth::user()->only(['id']);
        $attendances = attendance::where('work_end_time', '=',  null)->User_idSearch($user_id)->get();
        $attendanceid = [
            'attendance_id' => $attendances['0']['id']
        ];
        $bend = date('Y/m/d H:i:s');
        $bend = [
            'break_end_time' => $bend
        ];
        $bstart = breaktime::where('break_end_time', '=',  null)->where('attendance_id', '=',  $attendanceid)->first()->only(['break_start_time']);
        $bend2 = new DateTime($bend['break_end_time']);
        $bstart2 = new DateTime($bstart['break_start_time']);
        $btime = $bend2->diff($bstart2);
        $btime = $btime->format('%H:%I:%S');
        $btime = [
            'break_time' => $btime
        ];
        breaktime::where('break_end_time', '=',  null)->where('attendance_id', '=',  $attendanceid)->first()->update([
            'break_end_time' => $bend['break_end_time'],
            'break_time' => $btime['break_time']
        ]);
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

    public function date(){
        $date = attendance::select('date')->groupby('date')->orderby('date' , 'desc')->paginate(1, ['*'], 'date');
        $main = user::join('attendances','users.id','attendances.user_id')->orderBy('attendances.date', 'desc')->get();
        $breaktime = breaktime::get();

        return view('date', compact('date','main','breaktime'));
    }

    public function menber(){
        $user = user::paginate(5);
        return view('menber', compact('user'));
    }

    public function list(Request $request){
        $user = user::where('id', '=',  $request['id'])->first();
        $main = user::User_idSearch($request->id)->join('attendances','users.id','attendances.user_id')
                    ->orderBy('attendances.date', 'desc')->paginate(5);
        $breaktime = breaktime::get();
        return view('list', compact('user','main','breaktime'));
    }
}