<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function AllTeam(){
        $team =Team::latest()->get() ;
        return view('backend.team.all_team', compact('team'));
    }//end
    
    public function AddTeam(){
        return view('backend.team.add_team');
    }//end

    public function TeamStore(Request $request){
        
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('upload/team_img'), $name_gen);
        $save_url = 'upload/team_img/'.$name_gen;

        Team::insert([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Team Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.team')->with($notification);

    }//end

    public function EditTeam($id){
        $team = Team::findOrFail($id);
        return view('backend.team.edit_team', compact('team'));
    }//end

    public function TeamUpdate(Request $request){
        $team_id = $request->id;

        if($request->file('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/team_img'), $name_gen);
            $save_url = 'upload/team_img/'.$name_gen;

            Team::findOrFail($team_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Team Update With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.team')->with($notification);

        }else{
            Team::findOrFail($team_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Team Update Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.team')->with($notification);

        }//end else
       
    }//end Method

    public function DeleteTeam($id){
        $item = Team::findOrFail($id);
        $img = $item->image;
        unlink($img);

        Team::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Team Image Delete  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }


}
