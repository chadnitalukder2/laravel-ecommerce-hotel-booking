<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{
    public function frontendRoomAll(){
        $rooms = Room::latest()->get();
        return view('frontend.room.all_rooms', compact('rooms'));
    } //end method

    public function RoomDetailsPage($id) {
        $roomDetails = Room::find($id);
        $multiImage = MultiImage::where('room_id', $id)->get();
        $facility = Facility::where('room_id', $id)->get();
        return view('frontend.room.room_details', compact('roomDetails', 'multiImage', 'facility'));
    } // End Method 
}
