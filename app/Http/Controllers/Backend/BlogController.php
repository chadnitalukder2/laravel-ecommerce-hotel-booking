<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function BlogCategory(){

        $category = BlogCategory::latest()->get();
        return view('backend.blog_category.blog_category', compact('category'));
    }//End Method

    public function StoreBlogCategory(Request $request){
        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-', $request->category_name )), // Hotel Room = hotel-room
        ]);

        $notification = array(
            'message' => 'BlogCategory Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//End Method

    public function EditBlogCategory($id){
        $categories = BlogCategory::find($id);
        return response()->json($categories);
    }//End Method

    public function UpdateBlogCategory(Request $request){
        $cat_id= $request->cat_id;
        BlogCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)), // Hotel Room = hotel-room
        ]);

        $notification = array(
            'message' => 'BlogCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//End Method

    public function DeleteBlogCategory($id){
        BlogCategory::find($id)->delete();

        $notification = array(
            'message' => 'BlogCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//End Method

    //All Blog Post ==================================================================
    public function AllBlogPost(){
        $post = BlogPost::latest()->get();
        return view('backend.blog_post.all_blog_post', compact('post'));
    }//End Method

    public function AddBlogPost(){
        $blogcat = BlogCategory::latest()->get();
        return view('backend.blog_post.add_post', compact('blogcat'));
    }//End Method

    public function StoreBlogPost(Request $request){
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload/post_img'), $name_gen);
        $save_url = 'upload/post_img/' . $name_gen;

        BlogPost::insert([
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)), // Hotel Room = hotel-room,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Post  Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notification);


    }//End Method

    public function EditBlogPost($id){
        $blogcat = BlogCategory::latest()->get();
        $post = BlogPost::find($id);
        return view('backend.blog_post.edit_post', compact('blogcat', 'post'));
    }//End Method

    public function UpdateBlogPost(Request $request){
        $post_id = $request->id;

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/post_img'), $name_gen);
            $save_url = 'upload/post_img/' . $name_gen;

            BlogPost::findOrFail($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Post Update With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.post')->with($notification);
        } else {
            BlogPost::findOrFail($post_id)->update(['blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Post Update Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.post')->with($notification);
        }//end else
       
    }//End Method

    public function DeleteBlogPost($id){
        $item = BlogPost::findOrFail($id);
        $img = $item->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'BlogPost Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//End Method

    //frontend===========================================================

    public function BlogDetails($slug){
        $blog = BlogPost::where('post_slug', $slug)->first();
        $bcategory = BlogCategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_details', compact('blog', 'bcategory', 'lpost'));
    }//End Method

    public function BlogCatList($id){

        $blog = BlogPost::where('blogcat_id', $id)->get();
        $bcategory = BlogCategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();
        $namecat = BlogCategory::where('id', $id)->first();

        $blog = BlogPost::where('blogcat_id', $id)->get();
        return view('frontend.blog.blog_cat_list', compact('blog', 'bcategory', 'lpost', 'namecat'));
    }//End Method

    public function BlogList(){
        $blog = BlogPost::latest()->get();
        $bcategory = BlogCategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_all', compact('blog', 'bcategory', 'lpost'));
    }//End Method


}
