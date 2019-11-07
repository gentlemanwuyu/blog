<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/3
 * Time: 11:28
 */

namespace App\Modules\Backend\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Backend\Models\Article;
use App\Modules\Backend\Models\SummaryImage;

class ArticleService
{
    public function __construct()
    {

    }

    public function paginate($request)
    {
        $paginate = Article::orderBy('id', 'desc')->paginate($request->get('limit'));
        foreach ($paginate as $item) {
            $item->category_name = $item->category->name;
        }

        return $paginate;
    }

    /**
     * 保存配置
     *
     * @param $configs
     * @return array
     */
    public function saveArticle($request)
    {
        try {
            $data = [
                'title' => $request->get('title'),
                'keywords' => $request->get('keywords'),
                'content' => $request->get('content'),
                'summary' => $request->get('summary'),
                'category_id' => $request->get('category_id'),
                'summary_image_url' => $request->get('summary_image_url'),
                'summary_image_desc' => $request->get('summary_image_desc'),
            ];

            DB::beginTransaction();
            $article = Article::updateOrCreate(['id' => $request->get('article_id')], $data);

            if (!$article) {
                throw new \Exception("保存文章失败");
            }

            if ($request->get('is_sync_summary_image')) {
                $image_size = getimagesize($data['summary_image_url']);
                SummaryImage::create([
                    'url' => $data['summary_image_url'],
                    'desc' => $data['summary_image_desc'],
                    'width' => $image_size[0],
                    'height' => $image_size[1],
                ]);
            }

            $article->syncLabel($request->get('labels'));

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 删除文章
     *
     * @param $id
     * @return array
     */
    public function deleteArticle($id)
    {
        try {
            $article = Article::find($id);

            $article->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 保存摘要图片
     *
     * @param $url
     * @param $desc
     * @param int|null $summary_image_id
     * @return array
     */
    public function createOrUpdateSummaryImage($url, $desc, $summary_image_id = null)
    {
        try {
            $image_size = getimagesize($url);
            SummaryImage::updateOrCreate(['id' => $summary_image_id], [
                'url' => $url,
                'desc' => $desc,
                'width' => $image_size[0],
                'height' => $image_size[1],
            ]);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    public function summaryImagePaginate($request)
    {
        return SummaryImage::orderBy('id', 'desc')->paginate($request->get('limit'));
    }

    /**
     * 删除摘要图片
     *
     * @param $id
     * @return array
     */
    public function deleteSummaryImage($id)
    {
        try {
            $summary_image = SummaryImage::find($id);

            $summary_image->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}