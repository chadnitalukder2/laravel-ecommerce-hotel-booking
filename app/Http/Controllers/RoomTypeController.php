<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function RoomTypeList(){
        $allData = RoomType::orderBy('id', 'desc')->get();
        return view('backend.all_room.room_type.view_room_type', compact('allData'));
    }//end

    public function AddRoomType(){
        return view('backend.all_room.room_type.add_room_type');
    }//end

    public function RoomTypeStore(Request $request){
        RoomType::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'RoomType Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification);
    }//end
}
