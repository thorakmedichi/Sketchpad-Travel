<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function index(){
    	return view('admin.author');
    }
}
