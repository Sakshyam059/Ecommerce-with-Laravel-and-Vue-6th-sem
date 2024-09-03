<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with('category')->get();
        return Inertia::render('Banner/Index', compact('banners'));
    }
    public function create(Request $request)
    {
        $categories = Category::all();
        return Inertia::render('Banner/Create', compact('categories'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'image' => 'image|mimes:png,jpg',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $imagepath = time() . '_' . $fileName;
            $file->move(public_path('images/banner/'), $imagepath);
            $data['image'] = $imagepath;
        }
        Banner::create($data);

        return Redirect::route('banners.admin');
    }
    public function edit(Banner $banner){
        $categories=Category::all();
        return Inertia::render('Banner/Edit',compact('categories','banner'));
    }
    public function update(Banner $banner,Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $imagepath = time() . '_' . $fileName;
            
            $file->move(public_path('images/banner/'), $imagepath);
            $data['image'] = $imagepath;
        }
        $banner->update($data);

        return Redirect::route('banners.admin');
    }

    public function destroy(Banner $banner)
    {
        File::delete(public_path('images/banner/' . $banner->image));
        $banner->delete();
    }
}
