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
}
