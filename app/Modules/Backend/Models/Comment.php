<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/2
 * Time: 16:59
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    static $sources = [
        1 => '文章',
        2 => '关于',
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getSourcePageAttribute()
    {
        return isset(self::$sources[$this->source]) ? self::$sources[$this->source] : '';
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}