<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Section;
use App\Modules\Backend\Models\Category;
use App\Modules\Frontend\Services\ArticleService;

class SectionController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
	}

    public function index($id, Request $request)
    {
        $request->merge(['section_id' => $id, 'limit' => 10]);
        $section = Section::find($id);
        $articles = $this->articleService->paginate($request);
        $category_tree = Category::getTree($id);

        return view('frontend::section.index', compact('section', 'articles', 'category_tree'));
    }
}
