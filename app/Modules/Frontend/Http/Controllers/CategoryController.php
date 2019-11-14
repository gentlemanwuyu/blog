<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {

	}

    public function index($id, Request $request)
    {
        $articles = Article::where('category_id', $id)->OrderBy('id', 'desc')->limit(10)->get();
        $category = Category::find($id);
        $category_tree = Category::getTree($category->section_id);
        $request->merge(['section_id' => $category->section_id, 'category_id' => $id]);

        return view('frontend::category.index', compact('articles', 'category_tree'));
    }
}
