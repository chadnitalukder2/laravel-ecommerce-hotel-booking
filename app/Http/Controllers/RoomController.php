<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function EditRoom($id){
        $basic_facility = Facility::where('room_id', $id)->get(); 
        $editData = Room::find($id);
        return view('backend.all_room.rooms.edit_room', compact('editData', 'basic_facility'));
    }//end 
}
