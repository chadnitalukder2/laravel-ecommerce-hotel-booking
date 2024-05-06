<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class RoomController extends Controller
{
    public function EditRoom($id)
    {
        $basic_facility = Facility::where('room_id', $id)->get();
        $multi_imgs = MultiImage::where('room_id', $id)->get();
        $editData = Room::find($id);
        $allRoomNo = RoomNumber::where('room_id', $id)->get();
        return view('backend.all_room.rooms.edit_room', compact('editData', 'basic_facility', 'multi_imgs', 'allRoomNo'));
    } //end 

    public function UpdateRoom(Request $request, $id)
    {
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
        $room->status = 1;
        /// Update Single Image 

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/room_img/' . $room->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/room_img'), $filename);
            $room['image'] = $filename;
        }
        $room->save();

        //// Update for Facility Table 

        if ($request->facility_name == NULL) {

            $notification = array(
                'message' => 'Sorry! Not Any Basic Facility Select',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            Facility::where('room_id', $id)->delete();
            $facilities = Count($request->facility_name);
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->room_id = $room->id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->save();
            } // end for
        } // end else 

        //Update Multi Image

        if ($room->save()) {
            $files = $request->multi_image;

            if (!empty($files)) {
                $subimage = MultiImage::where('room_id', '$id')->get()->toArray();
                MultiImage::where('room_id', $id)->delete();
            } //end if

            if (!empty($files)) {
                foreach ($files as $file) {
                    $imgName = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('upload/room_img/multi_img/'), $imgName);
                    $subimage['multi_image'] = $imgName;


                    $subimage = new MultiImage();
                    $subimage->room_id = $room->id;
                    $subimage->multi_image = $imgName;
                    $subimage->save();
                }
            }
        } //end if 
        $notification = array(
            'message' => 'Room Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end

    public function MultiImageDelete($id)
    {
        $deleteData = MultiImage::where('id', $id)->first();
        if ($deleteData) {
            $imagePath = $deleteData->multi_image;

            //Check if the file exists before unlinking
            if (file_exists($imagePath)) {
                unlink($imagePath);
                echo "Image Unlink Successfully";
            } else {
                echo "Image does not exist";
            }
            //Delete The Record Database
            MultiImage::where('id', $id)->delete();
        }
        $notification = array(
            'message' => 'Multi Image Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method

    public function StoreRoomNumber(Request $request, $id)
    {
        $data = new RoomNumber();

        $data->room_id = $id;
        $data->room_type_id = $request->room_type_id;
        $data->room_no = $request->room_no;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'Room Number Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method

    public function EditRoomNo($id)
    {
        $editRoomNo = RoomNumber::find($id);
        return view('backend.all_room.rooms.edit_room_no', compact('editRoomNo'));
    } //end method

    public function UpdateRoomNumber(Request $request, $id)
    {
        $data = RoomNumber::find($id);
        $data->room_no = $request->room_no;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'Room Number Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification);
    } //end method

    public function DeleteRoomNo($id)
    {
        RoomNumber::find($id)->delete();
        $notification = array(
            'message' => 'Room Number Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification);
    } //end method

    public function DeleteRoom(Request $request, $id){

        $room = Room::find($id);

        //image
        if(file_exists('upload/room_ing/'.$room->image) AND !empty($room->image)){
            unlink('upload/room_ing/' . $room->image);
        }

        //multi Image
        $subimage = MultiImage::where('room_id', $room->id)->get()->toArray();
        if(!empty($subimage)){
            foreach ($subimage as  $value) {
                if(!empty($value)){
                    @unlink('upload/room_img/multi_img/' . $value['multi_image']);
                }
            } //end foreachfo

            RoomType::where('id', $room->roomtype_id)->delete();
            MultiImage::where('room_id', $room->id)->delete();
            Facility::where('room_id', $room->id)->delete();
            RoomNumber::where('room_id', $room->id)->delete();
            $room->delete();

            $notification = array(
                'message' => 'Room Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);  


        }
        

    }//end method

}
