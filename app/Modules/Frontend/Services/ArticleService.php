<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/14
 * Time: 15:46
 */

namespace App\Modules\Frontend\Services;

use App\Modules\Backend\Models\Article;

class ArticleService
{
    public function __construct()
    {

    }

    public function paginate($request)
    {
        $query = Article::query();

        if ($request->get('section_id')) {
            $query = $query->where('section_id', $request->get('section_id'));
        }

        $articles = $query->orderBy('id', 'desc')->paginate($request->get('limit'));

        foreach ($articles as $article) {
            $article->href = route('frontend::article.detail', ['id' => $article->id]);
            $article->category_name = $article->category->name;
            $create_date = $article->create_date;
            $article->create_date = $create_date;
            $comment_total = $article->comment_total;
            $article->comment_total = $comment_total;
        }

        return $articles;
    }
}