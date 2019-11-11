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
        $comments = Comment::orderBy('id', 'desc')->paginate($request->get('limit'));
        foreach ($comments as $comment) {
            $comment->source = $comment->source_page;
            $comment->parent_comment = $comment->parent ? $comment->parent->content : '';
            $comment->article_title = $comment->article ? $comment->article->title : '';
        }

        return $comments;
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