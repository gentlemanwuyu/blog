<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Backend\Services\FriendlinkService;
use App\Modules\Backend\Http\Requests\FriendlinkRequest;
use App\Modules\Backend\Models\Friendlink;

class FriendlinkController extends Controller
{
    protected $friendlinkService;

    public function __construct(FriendlinkService $friendlinkService)
    {
        $this->friendlinkService = $friendlinkService;
	}

    public function index()
    {
        return view('backend::friendlink.index');
    }

    public function paginate(Request $request)
    {
        return response()->json($this->friendlinkService->paginate($request));
    }

    public function createOrUpdateFriendlinkPage(Request $request)
    {
        $data = [];
        if ($request->get('friendlink_id')) {
            $friendlink = Friendlink::find($request->get('friendlink_id'));
            $data['friendlink'] = $friendlink;
        }

        return view('backend::friendlink.create_or_update_friendlink', $data);
    }

    public function createOrUpdateFriendlink(FriendlinkRequest $request)
    {
        return response()->json($this->friendlinkService->createOrUpdateFriendlink($request));
    }

    public function deleteFriendlink(Request $request)
    {
        return response()->json($this->friendlinkService->deleteFriendlink($request->get('friendlink_id')));
    }
}
