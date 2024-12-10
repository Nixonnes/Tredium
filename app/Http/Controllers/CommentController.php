<?php

namespace App\Http\Controllers;

use App\Jobs\CreateCommentJob;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        // Валидируем запрос
        $validated = $request->validate([
            'topic' => 'required|string|max:255',
            'message' => 'required|string',
            'article_id' => 'required|integer',
        ]);

        // Создаем задачу в очереди
        CreateCommentJob::dispatch($validated['topic'], $validated['message'], $validated['article_id']);

        // Отправляем клиенту ответ о получении запроса
        return response()->json(['message' => 'Комментарий обрабатывается'], 200);
    }
}
