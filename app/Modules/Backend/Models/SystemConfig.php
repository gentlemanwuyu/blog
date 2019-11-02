<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 12:03
 */

namespace App\Modules\Backend\Models;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}