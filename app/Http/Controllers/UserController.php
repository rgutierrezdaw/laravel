<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data = $this->loadUserVideos();
        //dd($data);
        return view('profile')->with('data', $data);
    }

    public function adminUsers(){
        $data = $this->getUsers();
        return view('adminUsers')->with('users', $data);
    }

    public function adminVideos(){
        $data = DB::table('videos')->join('users', 'videos.user_id','=', 'users.id')->select('users.name', 'videos.*')->get();
        return view('adminVideos')->with('videos', $data);
    }

    public function dropVideo($videoId){
        DB::table('videos')->where('id', $videoId)->delete();
        return app(UserController::class)->adminVideos();

    }

    protected function loadUserVideos(){
        $id = Auth::id();
        $sql = "SELECT id, title, path, created_at FROM videos WHERE user_id = $id";
        $data = DB::select($sql);
        return $data;
    }

    protected function getUsers(){
        $sql="SELECT * FROM users WHERE id <> 1;";
        $data = DB::select($sql);
        return $data;
    }

    protected function dropUser($userId){

        if(DB::table('role_user')->where('user_id', $userId)->delete()){
            DB::table('users')->whereId($userId)->delete();
        }
        return app(UserController::class)->adminUsers();
    }


    public function updateUser(Request $request){

        if($request->input('role') == 'user'){
            $role = (int)2;
        } else {
            $role = (int)3;
        }
        $name = $request->input('newname');
        $mail = $request->input('newmail');
        $pwd= Hash::make($request->input('newpassword'));

        $ud1="UPDATE role_user set role_id = $role where user_id = ".Auth::id().";";
        DB::update($ud1);
        $ud2="UPDATE users set name = '$name', email = '$mail', password = '$pwd', role_id = $role where id = ".Auth::id().";";
        DB::update($ud2);

        $data = DB::table('users')->where('id', Auth::id())->get();

        return view('profile')->with('newData', $data);
    }
}
