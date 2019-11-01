<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function __construct()
    {

	}

    public function getList()
    {
        return view('backend::label.list');
    }
}
