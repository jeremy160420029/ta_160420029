<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use App\Models\Image;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('main.article', compact('articles'));
    }

    public function indexadmin()
    {
        $articles = Article::all();
        return view('admin.article.admarticle', compact('articles'));
    }

    public function adminedit(Article $article)
    {
        $brands = Brand::all();
        return view('admin.article.updateadmarticle', compact('article', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('admin.article.admcreatearticle', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = Article::where("name", "=", $request->name)->first();

        if ($name) {
            return back()->withInput()->with("message", "Sudah ada");
        }

        $article = new Article();
        $article->name = $request->name;
        $article->release_date = $request->release_date;
        $article->retail_price = $request->retail_price;
        $article->resell_price = $request->resell_price;
        $article->description = $request->description;
        $article->brands_id = $request->brands_id;
        $article->save();

        return redirect()->route("admarticle.index")->with("message", "Insert Successfull");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // $shoes = Article::where('id', $article->id)->get();
        return view('main.shoes', compact('article'));
    }

    public function showAdm($id)
    {
        $articleDetail = Article::where('id', $id)->get();
        $image = Image::where('articles_id', $id)->get();
        return view('admin.article.admdetailarticle', compact("articleDetail", "image"));
    }

    public function searchArticle(Request $request)
    {
        $searchTerm = $request->input('search');

        $articles = Article::where('name', 'like', '%' . $searchTerm . '%')->get();

        return view('main.article', compact('articles'));
    }

    public function image($id)
    {
        $article = Article::find($id);

        $images = $article->images;

        return view('main.image', compact('article', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article = Article::where("id", "=", $article->id)->first();
        $article->name = $request->name;
        $article->release_date = $request->release_date;
        $article->retail_price = $request->retail_price;
        $article->resell_price = $request->resell_price;
        $article->description = $request->description;
        $article->brands_id = $request->brands_id;

        $article->save();
        return redirect()->route("admarticle.index")->with("message", "Update Successfull");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function deleteData(Request $request)
    {
        $id = $request->get('id');
        $dataArticle = Article::find($id);
        $dataImage = Image::where("articles_id", $id);
        $dataImage->delete();
        $dataArticle->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'Artikel berhasil dihapus'
        ), 200);
    }
}
