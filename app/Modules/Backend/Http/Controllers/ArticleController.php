<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Category;
use App\Modules\Backend\Models\Label;
use App\Modules\Backend\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function getList(Request $request)
    {
        return view('backend::article.list');
    }

    public function addArticle(Request $request)
    {
        $categories = Category::all();
        $labels = Label::all();

        return view('backend::article.create_or_update_article', compact('categories', 'labels'));
    }

    public function saveArticle(Request $request)
    {
        return response()->json($this->articleService->saveArticle($request));
    }
}
