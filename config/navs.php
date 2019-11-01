<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/1
 * Time: 19:24
 */

return [
    [
        'title' => '文章管理',
        'children' => [
            [
                'title' => '文章列表',
                'link' => '#',
            ],
            [
                'title' => '发布文章',
                'link' => '#',
            ],
        ],
    ],
    [
        'title' => '评论管理',
        'children' => [
            [
                'title' => '评论列表',
                'link' => '#',
            ],
        ],
    ],
    [
        'title' => '分类管理',
        'link' => '/admin/category/list',
    ],
    [
        'title' => '标签管理',
        'children' => [
            [
                'title' => '标签列表',
                'link' => '/admin/label/list',
            ],
        ],
    ],
    [
        'title' => '系统管理',
        'children' => [
            [
                'title' => '系统设置',
                'link' => '/admin/system/config',
            ],
            [
                'title' => '友情链接',
                'link' => '/admin/friendlink/index',
            ],
        ],
    ],
];