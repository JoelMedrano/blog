<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{

    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'body.required' => 'El body no es valido',
    ];

    public function index()
    {
        return new ArticleCollection(Article::paginate(20));
    }
    public function show(Article $article)
    {
        return response()->json(new ArticleResource($article),200);
    }
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ], self::$messages);

        $article = Article::create($request->all());
        return response()->json(new ArticleResource($article), 201);

    }
    public function update(Request $request,  Article $article)
    {
        $request->validate([
            'title' => 'required|string|unique:articles,title,' . $article->id . '|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ], self::$messages);

        $article->update($request->all());
        return response()->json($article, 200);
    }
    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
