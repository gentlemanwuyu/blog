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
            $comment->parent_name = $comment->parent ? $comment->parent->username : '';
            $children = $this->getChildrenComments($comment->id);
            if ($children) {
                $comment->children = $children;
            }
        }

        $comment_total = 0;
        if (1 == $request->get('source')) {
            $comment_total = Comment::where('article_id', $request->get('article_id'))->count();
        }elseif (2 == $request->get('source')) {
            $comment_total = Comment::where('source', 2)->count();
        }

        // 添加自定义属性
        return collect([
            'comment_total' => $comment_total,
        ])->merge($comments);
    }

    protected function getChildrenComments($parent_id)
    {
        $children = Comment::where('parent_id', $parent_id)->get();
        if ($children->isEmpty()) {
            return null;
        }
        foreach ($children as $child) {
            $child->avatar = Gravatar::get($child->email);
            $child->parent_name = $child->parent ? $child->parent->username : '';
            $subs = $this->getChildrenComments($child->id);
            if ($subs) {
                $child->children = $subs;
            }
        }

        return $children;
    }

    /**
     * 创建评论
     *
     * @param $request
     * @return array
     */
    public function createComment($request)
    {
        try {
            $data = [
                'content' => $request->get('text'),
                'username' => $request->get('author'),
                'email' => $request->get('mail'),
                'link' => $request->get('url'),
                'source' => $request->get('source'),
            ];
            if ($request->get('article_id')) {
                $data['article_id'] = $request->get('article_id');
            }
            if ($request->get('parent_id')) {
                $data['parent_id'] = $request->get('parent_id');
            }

            Comment::create($data);

            // 返回评论总数量
            $paginate_total = 0;
            if (1 == $request->get('source')) {
                $paginate_total = Comment::where('article_id', $request->get('article_id'))->where('parent_id', 0)->count();
            }elseif (2 == $request->get('source')) {
                $paginate_total = Comment::where('source', 2)->where('parent_id', 0)->count();
            }

            return ['status' => 'success', 'paginate_total' => $paginate_total];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}