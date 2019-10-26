<?php
namespace App\Modules\Frontend\Http\Controllers;

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
        return view('frontend::index.index');
    }

    public function about()
    {
        return view('frontend::index.about');
    }
}
