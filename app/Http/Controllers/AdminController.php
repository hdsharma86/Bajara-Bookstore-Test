<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Function to display admin home screen...
     */
    public function index(){
        return view('admin');
    }
}
