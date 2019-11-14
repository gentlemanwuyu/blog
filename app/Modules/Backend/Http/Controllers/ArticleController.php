<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use App\Modules\Backend\Models\Label;
use App\Modules\Backend\Models\Section;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\Category;
use App\Modules\Backend\Models\SummaryImage;
use App\Modules\Backend\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function getList(Request $request)
    {
        return view('backend::article.list');
    }

    public function paginate(Request $request)
    {
        return response()->json($this->articleService->paginate($request));
    }

    public function addArticle(Request $request)
    {
        $categories = [];
        foreach (Section::all() as $section) {
            $categories = array_merge($categories, Category::getTree($section->id));
        }
        $labels = Label::all();
        $data = compact('categories', 'labels');
        if ($request->get('article_id')) {
            $article = Article::find($request->get('article_id'));
            $data['article'] = $article;
        }

        return view('backend::article.create_or_update_article', $data);
    }

    public function saveArticle(ArticleRequest $request)
    {
        return response()->json($this->articleService->saveArticle($request));
    }

    public function deleteArticle(Request $request)
    {
        return response()->json($this->articleService->deleteArticle($request->get('article_id')));
    }

    public function upload(Request $request)
    {
        $image = $request->file('image');

        $ext = $image->extension();
        $image_name = uniqid();

        $result = Storage::disk('public')->put("images/article/{$image_name}.{$ext}", file_get_contents($image->path()), 'public');
        if ($result) {
            return response()->json(['status' => true, "url" => trim(env('APP_URL'), '/') . "/storage/images/article/{$image_name}.{$ext}"]);
        }else {
            return response()->json(['status' => false, "msg" => "图片上传失败"]);
        }
    }

    public function pasteUpload(Request $request)
    {
        if (!$request->get('image_url')) {
            return response()->json(['status' => false, "msg" => "图片地址无效：" . $request->get('image_url')]);
        }

        $content_type = get_content_type($request->get('image_url'));
        $array = explode('/', $content_type);

        if (!$ext = $array[1]) {
            return response()->json(['status' => false, "msg" => "获取图片后缀失败"]);
        }

        $image_name = uniqid();

        $result = Storage::disk('public')->put("images/article/{$image_name}.{$ext}", file_get_contents($request->get('image_url')), 'public');
        if ($result) {
            return response()->json(['status' => true, "url" => trim(env('APP_URL'), '/') . "/storage/images/article/{$image_name}.{$ext}"]);
        }else {
            return response()->json(['status' => false, "msg" => "图片上传失败"]);
        }
    }

    public function summaryImageLibrary(Request $request)
    {
        return view('backend::article.summary_image_library');
    }

    public function createOrUpdateSummaryImagePage(Request $request)
    {
        $data = [];
        if ($request->get('summary_image_id')) {
            $summary_image = SummaryImage::find($request->get('summary_image_id'));
            $data['summary_image'] = $summary_image;
        }

        return view('backend::article.create_or_update_summary_image', $data);
    }

    public function createOrUpdateSummaryImage(Request $request)
    {
        return response()->json($this->articleService->createOrUpdateSummaryImage($request->get('url'), $request->get('desc'), $request->get('summary_image_id')));
    }

    public function summaryImagePaginate(Request $request)
    {
        return response()->json($this->articleService->summaryImagePaginate($request));
    }

    public function deleteSummaryImage(Request $request)
    {
        return response()->json($this->articleService->deleteSummaryImage($request->get('summary_image_id')));
    }

    public function selectSummaryImagePage(Request $request)
    {
        return view('backend::article.select_summary_image', [
            'total' => SummaryImage::count(),
            'limit' => 12,
        ]);
    }
}
