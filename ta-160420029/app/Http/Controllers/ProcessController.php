<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('main.process', compact('articles'));
    }

    public function searchProcess(Request $request)
    {
        $searchTerm = $request->input('search');

        $articles = Article::where('name', 'like', '%' . $searchTerm . '%')->get();

        return view('main.process', compact('articles'));
    }
}
