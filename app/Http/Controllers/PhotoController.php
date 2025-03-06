<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PhotoController extends Controller
{
    private $v = [
        'filename' => 'required|file|image',
    ];

    private function storeImage($img,$fn){
        $manager = new ImageManager(new Driver());
        $manager->read($img)->resize(300,400)->save(public_path('photo/'.$fn));
    }

    public function index(Request $request){
        $user = $request->user();
        $user = User::with(['photos' => function($q){
            $q->orderBy('created_at','desc');
        }])->get()->findOrFail($user->id);
        $user->photos = $user->photos->groupBy(fn($photo) => $photo->created_at->format('Y-m-j'));
        return view('photos.index',compact('user'));
    }

    public function show(){
        dd('1');
    }

    public function create(){
        return view('photos.create');
    }

    public function store(Request $request){
        $user = $request->user();
        $request->validate($this->v);
        $file = $request->file('filename');
        Photo::create([
            'filename' => $file->hashName(),
            'user_id' => $user->id,
        ]);
        $this->storeImage($file,$file->hashName());
        return redirect()->route('photos.index');
    }

    public function destroy(Request $request,$id){
        $user = $request->user();
        $photo = $user->photos()->findOrFail($id);
        $photo->delete();
        return redirect()->route('photos.index');
    }
}
