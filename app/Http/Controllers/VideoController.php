<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
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
     public function index (Request $request)
     {
           $request->user()->authorizeRoles(['admin','loader']);
           return view('addVideo');
     }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request $request
     * @return \App\Models\Video
     */
    protected function create(Request $request)
    {
        $miniature = null;
        $result = null;
        /*if($request->hasFile('imagen') == null){
            $miniature = '../img/img-06.jpg';
        }else {
            $miniature = $request->file('imagen');
        }
         * */
        //dd($request->input('name'));
        $result = Video::create([
            'user_id' => Auth::id(),
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'path' => $request->file('file')->store('video', 'public'),
            'miniature' => $miniature
        ]);

        if($result != null){
            session()->flash('loadDone','¡video cargado correctamente!');
            return app(HomeController::class)->index($request);
        }else {
            session()->flash('loadFail','UPS! Parece que ha habido un problema, vuelve a intentarlo.');
            return view('video');
        }

    }

    protected function delete($video_id){
        DB::table('videos')->whereId($video_id)->delete();
        return app(UserController::class)->index();
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request $request
     * @param $id
     * @return \App\Models\Video
     */
    protected function show( $id){
        $sql = ("select users.name, videos.title, videos.created_at, videos.path, videos.miniature, videos.description from videos INNER JOIN users ON videos.user_id = users.id where videos.id = $id;");
        $data = DB::select($sql);
        return view('showVideo', compact('data'));
    }

}
