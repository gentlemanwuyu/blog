<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/31
 * Time: 15:57
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}