<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/15
 * Time: 19:38
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    const UPDATED_AT = null;

    protected $guarded = ['id', 'created_at'];
}