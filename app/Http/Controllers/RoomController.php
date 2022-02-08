<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\CallEvent;
use Illuminate\Support\Facades\Log;
use App\Services\CallStorage;

class RoomController extends Controller
{
    
    
    
    public function index(Request $re){
    		//event(new CallEvent("room-:name"));
		return view("create");
    }
    
    
    // join room
    public function create_room(Request $re){
    		
    		$data["room_name"] = $re->input("name");            
    		$data["room_link"] = route("join_room", ["name" => urlencode($re->name)]);      
    		
    		return view("room.caller", $data);
    }
    
    
    
    public function join_room(Request $re, $name){
    		
    		$room_name = urldecode($name);
    		
    		// check if room exists
    		
    		$data["room_name"] = $room_name;
    		return view("room.join", $data);
    }
    
    
    public function send_data(Request $re){
    		$ev = new CallEvent($re->input() );
    		event($ev);
    }
    
}
