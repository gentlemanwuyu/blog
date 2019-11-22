<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\Category;
use App\Modules\Frontend\Services\ArticleService;

class CategoryController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
	}

    public function index($id, Request $request)
    {
        $category = Category::find($id);
        $request->merge(['section_id' => $category->section_id, 'category_id' => $id, 'limit' => 10]);
        $articles = $this->articleService->paginate($request);
        $category_tree = Category::getTree($category->section_id);

        return view('frontend::category.index', compact('category', 'articles', 'category_tree'));
    }
}
