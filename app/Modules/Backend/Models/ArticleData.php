<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/16
 * Time: 15:02
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleData extends Model
{
    protected $table = 'article_data';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}