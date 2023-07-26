<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class Postcontroller extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $post =new Post([
            "nocm" =>$request->nocm,
            "user" =>$request->user,
            "nama" =>$request->nama,
            "pelayanan" => $request->pelayanan,
            "kunjungan" =>str_replace([' ', '-', ], '/', $request->kunjungan),
        ]);
       $post->save();

        if ($request->hasFile("images")) {
            $files = $request->file("images");

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $imageName = $request->kunjungan . $request->nocm . '.' . $extension;
                $imageName = str_replace(['/','-'],'', $imageName);
                $imageName = $this->makeUniqueImageName($imageName);
                $file->storeAs('public/post-img/', $imageName);
                $validatedData['image'] = $imageName;
                $validatedData['post_id'] = $post->id;

                Image::create($validatedData);
            }
        }

        return redirect("/");
    }

    private function makeUniqueImageName($imageName)
    {
        $name = pathinfo($imageName, PATHINFO_FILENAME);
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $number = 1;

        while (Storage::exists('public/post-img/' . $imageName)) {
            $imageName = $name . '-' . $number . '.' . $extension;
            $number++;
        }

        return $imageName;
    }

    public function edit($id)
    {
        $posts=Post::findOrFail($id);
        return view('edit')->with('posts',$posts);
    }

    public function view($id)
    {
        $posts=Post::findOrFail($id);
        return view('view')->with('posts',$posts);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->update([
            "nocm" => $request->nocm,
            "user" => $request->user,
            "nama" => $request->nama,
            "pelayanan" => $request->pelayanan,
            "kunjungan" => str_replace([' ', '-', ], '/', $request->kunjungan),
        ]);

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = str_replace(['', '-','/' ], '', $request->kunjungan) . $request->nocm . '.' . $file->getClientOriginalExtension();
                $imageName = $this->makeUniqueImageName($imageName);
                $file->storeAs('public/post-img/', $imageName);
                $validatedData['image'] = $imageName;
                $validatedData['post_id'] = $post->id;

                Image::create($validatedData);
            }
        }

        return redirect("/");
    }

    public function deleteimage($id) {
        $image = Image::findOrFail($id);
        $imagePath = 'public/post-img/' . $image->image;
        
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    
        Image::find($id)->delete();
        return back();
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        
        $images = Image::where("post_id", $post->id)->get();
        
        foreach ($images as $image) {
            $imagePath = 'public/post-img/' . $image->image;
            
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $image->delete();
        }
        
        $post->delete();
        
        return back();
    }

    public function search(Request $request){
        
        $search = $request->search;
        session(['search' => $search]);
        $posts = Post::where(function($query) use ($search){

            $query->where('nocm','like',"%$search%")
            ->orWhere('nama','like',"%$search%")
            ->orWhere('user','like',"%$search%")
            ->orWhere('pelayanan','like',"%$search%")
            ->orWhere('kunjungan','like',"%$search%");
            })->paginate(10);
            
            return view('search',compact('posts','search'));
    }



    public function exportLaporan(Request $request)
    {
        $search = session('search');
        $request->session()->forget('search');
        $fileName = 'Laporan_' . Carbon::now()->format('Ymd') . '.xlsx';
        return (new LaporanExport($search))->download($fileName);
    }
}