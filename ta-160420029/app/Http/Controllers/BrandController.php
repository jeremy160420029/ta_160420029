<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('main.brand', compact('brands'));
    }

    public function indexadmin()
    {
        $brands = Brand::all();
        return view('admin.brand.admbrand', compact('brands'));
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
        $name = Brand::where("name", "=", $request->name)->first();

        if ($name) {
            return back()->withInput()->with("message", "Sudah ada");
        }

        $brand = new Brand();
        $brand->name = $request->name;

        $file = $request->file('img');

        if ($file) {
            $imageContent = file_get_contents($file->getRealPath());
            $brand->image_brand = $imageContent;
        }

        $brand->save();

        return redirect()->route("admbrand.index")->with("message", "Insert Successfull");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $articles = Article::where("brands_id", $brand->id)->get();
        return view('main.article', compact('articles'));
    }

    public function searchBrand(Request $request)
    {
        $searchTerm = $request->input('search');

        $brands = Brand::where('name', 'like', '%' . $searchTerm . '%')->get();

        return view('main.brand', compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $brand = Brand::where("id", "=", $brand->id)->first();
        $brand->name = $request->name;

        $file = $request->file('img');

        if ($file) {
            $imageContent = file_get_contents($file->getRealPath());
            $brand->image_brand = $imageContent;
        }

        $brand->save();
        return redirect()->route("admbrand.index")->with("message", "Update Successfull");
    }

    public function updateBrand($id)
    {
        $brand = Brand::where("id", "=", $id)->first();
        return view('admin.brand.updateadmbrand', ['brand' => $brand]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }

    public function deleteData(Request $request)
    {
        $id = $request->get('id');
        $dataBrand = Brand::find($id);

        if (!$dataBrand) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Brand not found'
            ], 404);
        }

        $dataBrand->articles()->each(function ($article) {
            $article->images()->delete();
            $article->delete();
        });
        $dataBrand->delete();

        return response()->json([
            'status' => 'oke',
            'msg' => 'Brand, Articles, and Images berhasil dihapus'
        ], 200);
    }
}
