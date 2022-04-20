<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use DB;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::all();
        $adv = $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->orderBy('users.name', 'asc')->get();


        return view('agendamento.index',['events'=> $events,'advogados'=>$adv]);
    }
}
