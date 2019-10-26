<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {

    }

    public function detail($id)
    {
        return view('frontend::article.article');
    }
}
