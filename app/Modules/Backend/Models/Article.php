<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/3
 * Time: 13:12
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * 同步文章标签
     *
     * @param $label_ids
     * @return $this
     */
    public function syncLabel($label_ids)
    {
        $ori_label_ids = array_column(ArticleLabel::where('article_id', $this->id)->get()->toArray(), 'label_id');

        ArticleLabel::where('article_id', $this->id)->whereIn('label_id', array_diff($ori_label_ids, $label_ids))->delete();

        foreach (array_diff($label_ids, $ori_label_ids) as $label_id) {
            ArticleLabel::create(['article_id' => $this->id, 'label_id' => $label_id]);
        }

        return $this;
    }

    public function getLabelsAttribute()
    {
        $label_ids = ArticleLabel::where('article_id', $this->id)->pluck('label_id')->toArray();

        return Label::whereIn('id', $label_ids)->get();
    }

    public function labelIds()
    {
        return $this->hasMany(ArticleLabel::class)->select('label_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCreateDateAttribute()
    {
        return Carbon::parse($this->created_at)->toDateString();
    }

    /**
     * 上一篇文章
     *
     * @return mixed
     */
    public function getPreviousAttribute()
    {
        return DB::table('articles AS a')
            ->leftJoin('categories AS c', 'c.id', '=', 'a.category_id')
            ->where('c.section_id', $this->category->section_id)
            ->where('a.id', '<', $this->id)
            ->orderBy('a.id', 'desc')
            ->select('a.id', 'a.title')
            ->first();
    }

    /**
     * 下一篇文章
     *
     * @return mixed
     */
    public function getNextAttribute()
    {
        return DB::table('articles AS a')
            ->leftJoin('categories AS c', 'c.id', '=', 'a.category_id')
            ->where('c.section_id', $this->category->section_id)
            ->where('a.id', '>', $this->id)
            ->orderBy('a.id', 'desc')
            ->select('a.id', 'a.title')
            ->first();
    }

    /**
     * 评论分页时的总数
     *
     * @return mixed
     */
    public function getPaginateTotalAttribute()
    {
        return Comment::where('article_id', $this->id)->where('parent_id', 0)->count();
    }

    /**
     * 评论总数量
     *
     * @return mixed
     */
    public function getCommentTotalAttribute()
    {
        return Comment::where('article_id', $this->id)->count();
    }
}