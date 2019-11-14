<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\Category;

class SectionController extends Controller
{
    public function __construct()
    {
        
	}

    public function index($id, Request $request)
    {
        $articles = Article::where('section_id', $id)->OrderBy('id', 'desc')->limit(10)->get();
        $category_tree = Category::getTree($id);
        $paginate_total = Article::where('section_id', $id)->count();
        $request->merge(['section_id' => $id]);

        return view('frontend::section.index', compact('articles', 'category_tree', 'paginate_total'));
    }
}
