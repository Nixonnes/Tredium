<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateCommentJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $topic;
    protected $message;
    protected $article_id;
    /**
     * Create a new job instance.
     */
    public function __construct($topic, $message,$article_id)
    {
        $this->topic = $topic;
        $this->message = $message;
        $this->article_id = $article_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Чтобы имитировать длительное выполнение, мы добавляем задержку
         // 10 минут


        Comment::create([
            'subject' => $this->topic,
            'message' => $this->message,
            'article_id' => $this->article_id,
        ]);
        Log::info('Комментарий создан в фоне: ' . $this->topic);
    }
}
