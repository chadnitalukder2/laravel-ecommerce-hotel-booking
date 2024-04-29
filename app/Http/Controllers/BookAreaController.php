<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use Illuminate\Http\Request;

class BookAreaController extends Controller
{
    public function BookArea(){
        $book = BookArea::find(1);
        return view('backend.bookarea.book_area',compact('book'));
    }
}
