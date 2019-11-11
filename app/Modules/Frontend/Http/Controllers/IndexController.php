<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\Comment;
use App\Modules\Backend\Models\SystemConfig;

class IndexController extends Controller
{
    public function __construct()
    {

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
        $comment_total = Comment::where('source', 2)->count();

        return view('frontend::index.about', compact('about', 'paginate_total', 'comment_total'));
    }
}
