<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function AllTestimonial(){
        $testimonial = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial', compact('testimonial'));

    }//End method

    public function AddTestimonial(){
        return view('backend.testimonial.add_testimonial');
    }//End Method

    public function TestimonialStore(Request $request){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/testimonial_img'), $name_gen);
        $save_url = 'upload/testimonial_img/' . $name_gen;

        Testimonial::insert([
            'name' => $request->name,
            'city' => $request->city,
            'message' => $request->message,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Testimonial Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonial')->with($notification);
    }//End Method

    public function EditTestimonial($id){
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit_testimonial', compact('testimonial'));
    }//End Method

    public function UpdateTestimonial(Request $request){
        $testimonial_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/testimonial_id_img'), $name_gen);
            $save_url = 'upload/testimonial_id_img/' . $name_gen;

            Testimonial::findOrFail($testimonial_id)->update([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Testimonial Update With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.testimonial')->with($notification);
        } else {
            Testimonial::findOrFail($testimonial_id)->update([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Testimonial Update Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.testimonial')->with($notification);
        }//end else
    }//End Method


}
