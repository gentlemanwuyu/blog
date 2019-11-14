<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;
use App\Modules\Frontend\Services\ArticleService;

class LabelController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
	}

    public function index($id, Request $request)
    {
        $request->merge(['label_id' => $id, 'limit' => 10]);
        $articles = $this->articleService->paginate($request);

        return view('frontend::label.index', compact('articles'));
    }
}
