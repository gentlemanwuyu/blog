<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 17:08
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Friendlink extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}