<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/2
 * Time: 17:23
 */

namespace App\Modules\Backend\Services;

use App\Modules\Backend\Models\Comment;

class CommentService
{
    public function __construct()
    {

    }

    public function paginate($request)
    {
        return Comment::orderBy('id', 'desc')->paginate($request->get('limit'));
    }

    /**
     * 删除评论
     *
     * @param $id
     * @return array
     */
    public function deleteComment($id)
    {
        try {
            $comment = Comment::find($id);

            if (!$comment->children->isEmpty()) {
                throw new \Exception("该评论下还有回复，不能删除");
            }

            $comment->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}