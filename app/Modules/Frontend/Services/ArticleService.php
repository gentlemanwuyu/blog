<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/14
 * Time: 15:46
 */

namespace App\Modules\Frontend\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\ArticleLabel;

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
        if ($request->get('category_id')) {
            $query = $query->where('category_id', $request->get('category_id'));
        }
        if ($request->get('label_id')) {
            $article_ids = ArticleLabel::where('label_id', $request->get('label_id'))->pluck('article_id')->toArray();
            $query = $query->whereIn('id', $article_ids);
        }
        if ($search = $request->get('search')) {
            $article_ids = DB::table('articles AS a')
                ->leftJoin('article_labels AS al', 'al.article_id', '=', 'a.id')
                ->leftJoin('labels AS l', 'l.id', '=', 'al.label_id')
                ->where('l.name', $search)
                ->whereNull('a.deleted_at')
                ->whereNull('l.deleted_at')
                ->pluck('a.id');
            $query = $query->where(function ($q) use ($article_ids, $search) {
                $q->whereIn('id', $article_ids)->orWhere('title', 'like', "%{$search}%");
            });
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