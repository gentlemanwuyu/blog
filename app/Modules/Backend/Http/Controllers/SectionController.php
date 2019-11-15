<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Http\Requests\SectionRequest;
use App\Modules\Backend\Services\SectionService;

class SectionController extends Controller
{
    protected $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
	}

    public function getList(Request $request)
    {
        return view('backend::section.list');
    }

    public function paginate(Request $request)
    {
        return response()->json($this->sectionService->paginate($request));
    }

    public function createOrUpdateSection(SectionRequest $request)
    {
        return response()->json($this->sectionService->createOrUpdateSection($request));
    }

    public function deleteSection(Request $request)
    {
        return response()->json($this->sectionService->deleteSection($request->get('section_id')));
    }
}
