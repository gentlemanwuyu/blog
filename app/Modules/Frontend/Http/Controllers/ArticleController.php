<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;

class ArticleController extends Controller
{
    public function __construct()
    {

    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view('frontend::article.article', compact('article'));
    }
}
