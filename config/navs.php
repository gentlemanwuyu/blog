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
        'icon' => 'layui-icon layui-icon-list',
        'children' => [
            [
                'title' => '文章列表',
                'icon' => 'layui-icon layui-icon-list',
                'link' => '/admin/article/list',
            ],
            [
                'title' => '发布文章',
                'icon' => 'layui-icon layui-icon-release',
                'link' => '/admin/article/add_article',
            ],
            [
                'title' => '摘要图片库',
                'icon' => 'layui-icon layui-icon-picture',
                'link' => '/admin/article/summary_image_library',
            ],
        ],
    ],
    [
        'title' => '评论管理',
        'icon' => 'layui-icon layui-icon-reply-fill',
        'children' => [
            [
                'title' => '评论列表',
                'icon' => 'layui-icon layui-icon-reply-fill',
                'link' => '/admin/comment/list',
            ],
        ],
    ],
    [
        'title' => '分类管理',
        'icon' => 'layui-icon layui-icon-tree',
        'link' => '/admin/category/list',
    ],
    [
        'title' => '标签管理',
        'icon' => 'layui-icon layui-icon-note',
        'children' => [
            [
                'title' => '标签列表',
                'icon' => 'layui-icon layui-icon-note',
                'link' => '/admin/label/list',
            ],
        ],
    ],
    [
        'title' => '系统管理',
        'icon' => 'layui-icon layui-icon-set',
        'children' => [
            [
                'title' => '系统设置',
                'icon' => 'layui-icon layui-icon-set-sm',
                'link' => '/admin/system/config',
            ],
            [
                'title' => '友情链接',
                'icon' => 'layui-icon layui-icon-link',
                'link' => '/admin/friendlink/index',
            ],
            [
                'title' => '系统日志',
                'icon' => 'layui-icon layui-icon-template-1',
                'link' => '/admin/system/logs',
            ],
        ],
    ],
];