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

    public function labelIds()
    {
        return $this->hasMany(ArticleLabel::class)->select('label_id');
    }
}