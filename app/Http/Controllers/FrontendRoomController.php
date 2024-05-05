<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{
    public function frontendRoomAll(){
        $rooms = Room::latest()->get();
        return view('frontend.room.all_rooms', compact('rooms'));
    }//end method
}
