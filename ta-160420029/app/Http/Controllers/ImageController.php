<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $img = new Image();
        $file = $request->file('img');

        if ($file) {
            $imageContent = file_get_contents($file->getRealPath());
            $img->image = $imageContent;
        }

        $img->articles_id = $request->articles_id;
        $img->save();


        return redirect()->route("admarticle.index")->with("message", "Insert Successfull");
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

    public function showAdm($id)
    {
        $imageDetail = History::where('id', $id)->get();
        return view('admin.history.admdetailimg', compact("imageDetail"));
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

    public function deleteData(Request $request)
    {
        $id = $request->get('id');
        $dataImage = Image::find($id);
        $dataImage->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'Gambar berhasil di hapus'
        ), 200);
    }
}
