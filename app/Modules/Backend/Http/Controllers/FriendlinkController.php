<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FriendlinkController extends Controller
{
    public function __construct()
    {
        
	}

    public function index()
    {
        return view('backend::friendlink.index');
    }
}
