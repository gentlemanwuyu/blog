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
}