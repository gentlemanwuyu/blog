<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Http\Requests\VisitorRequest;
use App\Modules\Backend\Services\VisitorService;

class VisitorController extends Controller
{
    protected $visitorService;

    public function __construct(VisitorService $visitorService)
    {
        $this->visitorService = $visitorService;
	}

    public function track(VisitorRequest $request)
    {
        return response()->json($this->visitorService->track($request));
    }
}
