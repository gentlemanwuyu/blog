<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
	}

    public function getList(Request $request)
    {
        return view('backend::category.list');
    }

    public function getTree(Request $request)
    {
        return response()->json($this->categoryService->getTree($request->get('section_id')));
    }

    public function createOrUpdateCategory(Request $request)
    {
        return response()->json($this->categoryService->createOrUpdateCategory($request));
    }

    public function deleteCategory(Request $request)
    {
        return response()->json($this->categoryService->deleteCategory($request->get('category_id')));
    }
}
