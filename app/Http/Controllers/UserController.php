<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $data = $this->loadUserVideos();
        //dd($data);
        return view('profile')->with('data', $data);
    }

    protected function loadUserVideos(){
        $id = Auth::id();
        $sql = "SELECT id, title, path, created_at FROM videos WHERE user_id = $id";
        $data = DB::select($sql);
        return $data;
    }
}
