<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        
	}

    public function index()
    {
        return view('backend::index.index');
    }

    public function loginPage()
    {
        return view('backend::index.login');
    }
}
