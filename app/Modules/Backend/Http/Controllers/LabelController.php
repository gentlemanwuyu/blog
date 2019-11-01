<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Services\LabelService;

class LabelController extends Controller
{
    protected $labelService;

    public function __construct(LabelService $labelService)
    {
        $this->labelService = $labelService;
	}

    public function getList()
    {
        return view('backend::label.list');
    }

    public function paginate(Request $request)
    {
        return response()->json($this->labelService->paginate($request));
    }
}
