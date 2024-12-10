<?php

namespace App\Http\Controllers;

use App\Console\Commands\SyncCounters;
use App\Models\Article;
use App\Models\Tag;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class ArticleController extends Controller
{
    protected ArticleService $service;
    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function dashboard()
    {
        $articles = Article::latest()->take(6)->get();
        return Inertia::render('Dashboard', [
        'articles' => $articles->map(function ($article) {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'body' => $article->body,
            'slug' => $article->slug,
            'views' => $article->views,
            'likes' => $article->likes,
            'excerpt' => $this->service->getExcerpt($article->body),
            'thumbnail_url' => $article->thumbnail_url,
        ];
    }),
            ]);
    }
    public function index()
    {
        return Inertia::render('Articles/Index', [
            'tags' => Tag::whereHas('articles')->get(),
            'articles' => Article::paginate(10)
        ]);
    }
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return Inertia::render('Articles/Show', [
            'article' => $article,
            'tags' => $article->tags()->get(),
        ]);
    }
    public function incrementViews($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $key = "article:{$slug}:views";


        // Увеличиваем счетчик в Redis
        Redis::incr($key);
        $value = Redis::get($key);
        Artisan::queue('sync:counters');
        $article->views = $value;
        $article->save();
        return response()->json(['views' => $article->views], 200);
    }
    public function incrementLikes($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $key = "article:{$slug}:likes";
        // Увеличиваем счетчик в Redis
        Redis::incr($key);
        $value = Redis::get($key);
        Artisan::queue('sync:counters');
        // Синхронизируем с базой данных
        $article->likes = $value;
        $article->save();
        return response()->json(['likes' => $article->likes], 200);
    }
}
