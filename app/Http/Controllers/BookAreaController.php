<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookAreaController extends Controller
{
    public function BookArea(){
        $book = BookArea::find(1);
        return $book;
        return view('backend.bookarea.book_area',compact('book'));
    }//end

    public function UpdateBookArea(Request $request){
        $book_id = $request->id;
        if($request->file('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/bookarea_img'), $name_gen);
            $save_url = 'upload/bookarea_img/'.$name_gen;

            BookArea::findOrFail($book_id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Book Area Update With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }else{
            BookArea::findOrFail($book_id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Book Area Update Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }//end else
       

    }//end
}


