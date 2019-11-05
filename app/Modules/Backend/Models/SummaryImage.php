<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/5
 * Time: 19:41
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SummaryImage extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}