<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{


    public function randomimage()
    {
        // restituisce una foto random
        $response = Http::get('https://api.unsplash.com/photos/random/?client_id=' . env('UNSPLASH_ACCESS_KEY'));
        $image_src = $response->json();
        // dd($image_src);

        // per vedere la foto ci serve l'url che a sua volta comprende:
        // full     returns the photo in jpg format with its maximum dimensions.
        // regular  returns the photo in jpg format with a width of 1080 pixels.
        // small    returns the photo in jpg format with a width of 400 pixels.
        // thumb    returns the photo in jpg format with a width of 200 pixels.
        // raw      returns a base image URL with just the photo path and the ixid parameter for your API application.
        //          Use this to easily add additional image parameters to construct your own image URL.
        $image_url = $image_src['urls']['small'];
        
        // $image_download = $image_src['links']['download'];
        // dd($image_download);

        $image_author = $image_src['user']['name'];
        $image_author_link = $image_src['user']['links']['html'];

        return view('main', ['image' => $image_url, 'image_id' => $image_src['id']]);

    }    
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main', [ 'image_id' => '' ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {

        dd($request, $id);

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image_path = $request->file('image')->store('image', 'public');

        // $data = Image::create([
        Image::create([
            'image' => $image_path,
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route('main');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
