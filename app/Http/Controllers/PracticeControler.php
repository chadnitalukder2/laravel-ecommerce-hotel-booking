<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PracticeControler extends Controller
{
    public function practice() {
        return view('admin.practice_page');
    }
}
