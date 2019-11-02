<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('backend::article.create_or_update_article');
    }
}
