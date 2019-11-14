<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\Comment;
use App\Modules\Backend\Models\SystemConfig;
use App\Modules\Frontend\Services\ArticleService;

class IndexController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $articles = Article::OrderBy('id', 'desc')->limit(10)->get();

        return view('frontend::index.index', compact('articles'));
    }

    public function about()
    {
        $about = SystemConfig::where('name', 'about')->value('value');
        $paginate_total = Comment::where('source', 2)->where('parent_id', 0)->count();

        return view('frontend::index.about', compact('about', 'paginate_total', 'comment_total'));
    }

    public function search(Request $request)
    {
        $request->merge(['limit' => 10]);
        $articles = $this->articleService->paginate($request);

        return view('frontend::index.search', compact('articles'));
    }
}
