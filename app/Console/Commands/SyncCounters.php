<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\Models\Article;

class SyncCounters extends Command
{
protected $signature = 'sync:counters';

protected $description = 'Sync article`s views and likes counters from Redis to database';

public function __construct()
{
parent::__construct();
}

public function handle()
{
$articles = Article::all();

foreach ($articles as $article) {
// Получаем количество просмотров и лайков из Redis
$views = Redis::get("article:{$article->slug}:views");
$likes = Redis::get("article:{$article->slug}:likes");

// Если данные существуют в Redis, обновляем их в базе данных
if ($views !== null) {
$article->views = $views;
}

if ($likes !== null) {
$article->likes = $likes;
}

// Сохраняем обновленные данные в базе
$article->save();
}
}
}
