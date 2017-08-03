<?php

namespace App\Http\Controllers;

use App\Blog;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data = [
            'blogs' => Blog::get()
        ];
        return view('admin.content.dashboard.index', $data);
    }
}
