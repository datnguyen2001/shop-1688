<?php

return [
    'admin' => [
//        [
//            'name' => 'home',
//            'title' => 'Home',
//            'icon' => 'bi bi-grid',
//            'route' => 'admin.index',
//            'submenu' => [],
//            'number' => 1
//        ],
        [
            'name' => 'order',
            'title' => 'Quản lý đơn hàng',
            'icon' => 'bi bi-grid',
            'route' => 'admin.order.index',
            'parameters' => ['status' => 'all'],
            'submenu' => [],
            'number' => 2
        ],
        [
            'name' => 'category',
            'title' => 'Quản lý danh mục',
            'icon' => 'bi bi-grid',
            'route' => 'admin.category.index',
            'submenu' => [],
            'number' => 3
        ],
        [
            'name' => 'product',
            'title' => 'Quản lý sản phẩm',
            'icon' => 'bi bi-grid',
            'route' => 'admin.product.index',
            'submenu' => [],
            'number' => 4
        ],
//        [
//            'name' => 'category-product',
//            'title' => 'Quản lý sản phẩm',
//            'icon' => 'bi bi-grid',
//            'route' => null,
//            'submenu' => [
//                [
//                    'title' => 'Danh mục sản phẩm',
//                    'route' => 'admin.category.index',
//                    'name' => 'category'
//                ],
//                [
//                    'title' => 'Sản phẩm',
//                    'route' => 'admin.product.index',
//                    'name' => 'product'
//                ],
//            ],
//            'number' => 3
//        ],
//        [
//            'name' => 'post',
//            'title' => 'Quản lý bài viết',
//            'icon' => 'bi bi-grid',
//            'route' => null,
//            'submenu' => [
//                [
//                    'title' => 'Danh mục',
//                    'route' => 'admin.category-post.index-cate',
//                    'name' => 'category'
//                ],
//                [
//                    'title' => 'Bài viết',
//                    'route' => 'admin.post.index',
//                    'name' => 'blog'
//                ],
//            ],
//            'number' => 4
//        ],
        [
            'name' => 'category-post',
            'title' => 'Danh mục bài viết',
            'icon' => 'bi bi-grid',
            'route' => 'admin.category-post.index-cate',
            'submenu' => [],
            'number' => 5
        ],
        [
            'name' => 'blog',
            'title' => 'Quản lý bài viết',
            'icon' => 'bi bi-grid',
            'route' => 'admin.post.index',
            'submenu' => [],
            'number' => 6
        ],
//        [
//            'name' => 'contact',
//            'title' => 'Liên hệ',
//            'icon' => 'bi bi-grid',
//            'route' => null,
//            'submenu' => [
//                [
//                    'title' => 'Danh sách liên hệ',
//                    'route' => 'admin.contact',
//                    'name' => 'list-contact'
//                ],
//                [
//                    'title' => 'Danh sách đăng ký nhận bản tin',
//                    'route' => 'admin.contact-newsletter',
//                    'name' => 'contact-newsletter'
//                ],
//            ],
//            'number' => 5
//        ],
        [
            'name' => 'list-contact',
            'title' => 'Danh sách liên hệ',
            'icon' => 'bi bi-grid',
            'route' => 'admin.contact',
            'submenu' => [],
            'number' => 7
        ],
        [
            'name' => 'contact-newsletter',
            'title' => 'Danh sách đăng ký nhận bản tin',
            'icon' => 'bi bi-grid',
            'route' => 'admin.contact-newsletter',
            'submenu' => [],
            'number' => 8
        ],
        [
            'name' => 'support-staff',
            'title' => 'Hỗ trợ trực tuyến',
            'icon' => 'bi bi-grid',
            'route' => 'admin.support-staff.index',
            'submenu' => [],
            'number' => 9
        ],
        [
            'name' => 'system',
            'title' => 'Hệ thống',
            'icon' => 'bi bi-grid',
            'route' => 'admin.system.index',
            'submenu' => [],
            'number' => 10
        ],
        [
            'name' => 'user',
            'title' => 'Quản lý người dùng',
            'icon' => 'bi bi-grid',
            'route' => 'admin.user.index',
            'submenu' => [],
            'number' => 11
        ],
        [
            'name' => 'staff',
            'title' => 'Quản lý nhân viên',
            'icon' => 'bi bi-grid',
            'route' => 'admin.role.index',
            'submenu' => [],
            'number' => 12
        ],

]
];
