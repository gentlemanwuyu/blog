<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Category;
use App\Modules\Backend\Models\Label;

class ArticleController extends Controller
{
    public function __construct()
    {

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
}
