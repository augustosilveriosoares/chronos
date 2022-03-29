<?php

namespace App\Http\Controllers;

use App\Event;
use DB;




class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $adv = $advogado = DB::table('users')->join('roles','roles.id','=','users.role_id')->where('roles.name','=','Advogado')->select('users.*')->get();


        return view('agendamento.index',['events'=> $events,'advogados'=>$adv]);
    }
}
