<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function ContactUs(){

        return view('frontend.contact.contact_us');
    }//End Method
}
