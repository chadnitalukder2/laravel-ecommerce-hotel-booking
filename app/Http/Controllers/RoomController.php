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

    public function UpdateRoom(Request $request, $id){
        $room = Room::find($id);
        $room->roomtype_id = $room->roomtype_id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->price;

        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style;
        $room->discount = $request->discount;
        $room->short_desc = $request->short_desc;
        $room->description = $request->description; 
        /// Update Single Image 

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/room_img/'.$room->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/room_img'), $filename);
            $room['image'] = $filename;
        }
        $room->save();


    }//end
}
