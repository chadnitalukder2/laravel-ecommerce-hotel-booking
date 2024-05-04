<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class RoomController extends Controller
{
    public function EditRoom($id){
        $basic_facility = Facility::where('room_id', $id)->get(); 
        $multi_imgs = MultiImage::where('room_id', $id)->get(); 
        $editData = Room::find($id);
        return view('backend.all_room.rooms.edit_room', compact('editData', 'basic_facility','multi_imgs' ));
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

         //// Update for Facility Table 

         if($request->facility_name == NULL){

            $notification = array(
                'message' => 'Sorry! Not Any Basic Facility Select',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else{
            Facility::where('room_id',$id)->delete();
            $facilities = Count($request->facility_name);
            for($i=0; $i < $facilities; $i++ ){
                $fcount = new Facility();
                $fcount->room_id = $room->id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->save();
            } // end for
        } // end else 

        //Update Multi Image

        if( $room->save()){
            $files = $request->multi_image;

            if( !empty($files)){
                $subimage = MultiImage::where('room_id', '$id')->get()->toArray();
                MultiImage::where('room_id', $id)->delete();
            }//end if

            if(!empty($files)){
                foreach($files as $file){
                    $imgName = date('YmdHi').$file->getClientOriginalName();
                    $file->move(public_path('upload/room_img/multi_img/'), $imgName);
                    $subimage['multi_image'] = $imgName;


                    $subimage = new MultiImage();
                    $subimage->room_id = $room->id;
                    $subimage->multi_image = $imgName;
                    $subimage->save();
                }
            }

        }//end if 
        $notification = array(
            'message' => 'Room Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }//end


    public function MultiImageDelete($id){
        $deleteData = MultiImage::where('id', $id)->first();
        if($deleteData){
            $imagePath = $deleteData->multi_image;

            //Check if the file exists before unlinking
            if(file_exists($imagePath)){
                unlink($imagePath);
                echo "Image Unlink Successfully";
            }else{
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
    }//end method
}
