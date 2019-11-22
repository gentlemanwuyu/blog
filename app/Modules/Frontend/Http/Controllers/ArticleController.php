<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;
use App\Modules\Frontend\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function detail($id)
    {
        $article = Article::find($id);
        if (!$article) {
            abort(404);
        }

        return view('frontend::article.article', compact('article'));
    }

    public function paginate(Request $request)
    {
        return response()->json($this->articleService->paginate($request));
    }
}
