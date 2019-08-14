<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('CEO'))
            return view('pages.ceo');
        if ($user->hasRole('Manager'))
            return view('pages.administrator');
        return view('pages.staff');
    }

    public function workData()
    {
        $works = Auth::user()->staff->works;
        $res = [];
        foreach ($works as $work){
            $arr = [];
            $arr['id'] = $work->id;
            $arr['name'] = $work->staff->user->name;
            $arr['content'] = $work->content;
            $arr['created_at'] = $work->created_at->toDateTimeString();
            array_push($res, $arr);
        }
        $data = [
            "code" => 0,
            "msg" => "",
            "count" => count($works),
            "data" => $res
        ];
        return json_encode($data);
    }

    public function staffData()
    {
        $staff = Auth::user()->staffs;
        $res = [];
        foreach ($staff as $s){
            $arr = [];
            $arr['id'] = $s->id;
            $arr['name'] = $s->user->name;
            $arr['created_at'] = $s->created_at->toDateTimeString();
            array_push($res, $arr);
        }
        $data = [
            "code" => 0,
            "msg" => "",
            "count" => count($staff),
            "data" => $res
        ];
        return json_encode($data);
    }

    public function allData()
    {
        $users = User::where('id', '<>', Auth::user()->id)->get();
        $res = [];
        foreach ($users as $user){
            $arr = [];
            $arr['id'] = $user->id;
            $arr['name'] = $user->name;
            $arr['email'] = $user->email;
            $arr['created_at'] = $user->created_at->toDateTimeString();
            array_push($res, $arr);
        }
        $data = [
            "code" => 0,
            "msg" => "",
            "count" => count($users),
            "data" => $res
        ];
        return json_encode($data);
    }
}
