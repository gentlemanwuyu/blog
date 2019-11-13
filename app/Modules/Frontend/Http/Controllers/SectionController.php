<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\Article;

class SectionController extends Controller
{
    public function __construct()
    {
        
	}

    public function index($id)
    {
        $articles = Article::OrderBy('id', 'desc')->get();

        return view('frontend::section.index', compact('articles'));
    }
}
