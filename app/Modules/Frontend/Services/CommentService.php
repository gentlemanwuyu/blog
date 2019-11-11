<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/10
 * Time: 17:12
 */

namespace App\Modules\Frontend\Services;

use Creativeorange\Gravatar\Facades\Gravatar;
use App\Modules\Backend\Models\Comment;

class CommentService
{
    public function __construct()
    {

    }

    public function paginate($request)
    {
        $query = Comment::where('source', $request->get('source'));
        if (1 == $request->get('source')) {
            $query = $query->where('article_id', $request->get('article_id'));
        }
        $comments = $query->where('parent_id', 0)->orderBy('id', 'desc')->paginate($request->get('limit'));

        foreach ($comments as $comment) {
            $comment->avatar = Gravatar::get($comment->email);
            $children = $this->getChildrenComments($comment->id);
            if ($children) {
                $comment->children = $children;
            }
        }

        return $comments;
    }

    protected function getChildrenComments($parent_id)
    {
        $children = Comment::where('parent_id', $parent_id)->get();
        if ($children->isEmpty()) {
            return null;
        }
        foreach ($children as $child) {
            $child->avatar = Gravatar::get($child->email);
            $subs = $this->getChildrenComments($child->id);
            if ($subs) {
                $child->children = $subs;
            }
        }

        return $children;
    }
}