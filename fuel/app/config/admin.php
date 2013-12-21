<?php
return [
    'navs' => [
        ['name' => '管理首页', 'href' => Uri::create('/admin')],
        [
            'name' => '系统管理', 
            'href' => 'javascript:void(0);', 
            'class' => 'dropdown',
            'childs' => [
                ['name' => '商品分类', 'href' => Uri::create('/admin/cates/cate')],
                ['name' => '商品品牌', 'href' => Uri::create('/admin/cates/brand')]
            ],
        ],
        [
            'name' => '公告邮件',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '公告列表', 'href' => Uri::create('/admin/notices')],
                ['name' => '邮件列表', 'href' => Uri::create('/admin/emails')],
            ]
        ],
        [
            'name' => '日志管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '管理日志', 'href' => Uri::create('/admin/logs/admin')],
                ['name' => '用户日志', 'href' => Uri::create('/admin/logs/member')],
            ]
        ],
        [
            'name' => '用户管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '管理员列表', 'href' => Uri::create('/admin/users')],
                ['name' => '会员列表', 'href' => Uri::create('/admin/members')],
                ['name' => '会员黑名单', 'href' => Uri::create('/admin/mambers/black')],
            ]
        ],
        [
            'name' => '广告管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加图片', 'href' => Uri::create('/admin/ads/create')],
                ['name' => '广告列表', 'href' => Uri::create('/admin/ads')],
                ['name' => '友情连接', 'href' => Uri::create('/admin/links')],
            ]
        ],
        [
            'name' => '商品管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '添加商品', 'href' => Uri::create('/admin/items/create')],
                ['name' => '商品列表', 'href' => Uri::create('/admin/items')],
            ]
        ],
        ['name' => '晒单管理', 'href' => Uri::create('/admin/posts')],
        [
            'name' => '财务管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '用户消费', 'href' => Uri::create('/admin/')],
                ['name' => '用户充值', 'href' => Uri::create('/admin/items')],
            ]
        ],
        [
            'name' => '运营管理',
            'href' => 'javascript:void(0);',
            'class' => 'dropdown',
            'childs' => [
                ['name' => '运营人员', 'href' => Uri::create('/admin/')],
                ['name' => '数据分析', 'href' => Uri::create('/admin/items')],
            ]
        ],
    ]
];
