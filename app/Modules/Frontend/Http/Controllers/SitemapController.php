<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Modules\Backend\Models\Section;
use App\Modules\Backend\Models\Article;

class SitemapController extends Controller
{
    public function __construct()
    {
        
	}

    public function index()
    {
        $pages = [];

        $pages[] = [
            'loc' => route('frontend::index.about'),
            'lastmod' => Carbon::now()->toDateString()
        ];

        $sections = Section::orderBy('updated_at', 'desc')->get(['id']);
        foreach ($sections as $section) {
            $pages[] = [
                'loc' => route('frontend::section.index', ['id' => $section->id]),
                'lastmod' => Carbon::now()->toDateString()
            ];
        }

        $articles = Article::orderBy('updated_at', 'desc')->get(['id', 'title', 'updated_at']);
        foreach ($articles as $article) {
            $pages[] = [
                'loc' => route('frontend::article.detail', ['id' => $article->id]),
                'lastmod' => Carbon::now()->toDateString()
            ];
        }

        return response()->view('frontend::sitemap.index', compact('pages'))->header('Content-Type', 'text/xml');
    }
}
