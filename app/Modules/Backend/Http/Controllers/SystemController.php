<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Models\SystemConfig;
use App\Modules\Backend\Services\SystemService;

class SystemController extends Controller
{
    protected $systemService;

    public function __construct(SystemService $systemService)
    {
        $this->systemService = $systemService;
	}

    public function config()
    {
        $all_configs = array_column(SystemConfig::all()->toArray(), 'value', 'name');

        return view('backend::system.config', compact('all_configs'));
    }

    public function saveConfig(Request $request)
    {
        return response()->json($this->systemService->saveConfig($request->all()));
    }
}
