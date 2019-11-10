<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;

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
        return view('frontend::index.about');
    }
}
