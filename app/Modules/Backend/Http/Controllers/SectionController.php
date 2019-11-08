<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        
	}

    public function getList(Request $request)
    {
        return view('backend::section.list');
    }
}
