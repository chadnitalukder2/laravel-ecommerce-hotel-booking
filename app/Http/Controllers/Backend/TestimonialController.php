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


}
