<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function EditRoom($id){
        $editData = Room::find($id);
        return view('backend.all_room.rooms.edit_room', compact('editData'));
    }//end 
}
