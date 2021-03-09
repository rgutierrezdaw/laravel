<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin', 'guest', 'loader']);
        $sql = ("select users.name, videos.title, videos.created_at, videos.path, videos.miniature, videos.id from videos INNER JOIN users ON videos.user_id = users.id;");
        $data = DB::select($sql);
        return view('home', compact('data'));
    }
}
