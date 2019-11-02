<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
	}

    public function getList(Request $request)
    {
        return view('backend::comment.list');
    }

    public function paginate(Request $request)
    {
        return response()->json($this->commentService->paginate($request));
    }

    public function deleteComment(Request $request)
    {
        return response()->json($this->commentService->deleteComment($request->get('comment_id')));
    }
}
