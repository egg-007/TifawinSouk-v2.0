<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    */
    'title' => 'Tifawin Souk',
    'title_prefix' => '',
    'title_postfix' => ' | Admin',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    */
    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    */
    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    */
    'logo' => '<b>Tifawin</b>Souk',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_alt' => 'Tifawin Souk',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    */
    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_image' => false,
    'usermenu_desc' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    */
    'layout_topnav' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_dark_mode' => false,

    /*
    |--------------------------------------------------------------------------
    | Classes
    |--------------------------------------------------------------------------
    */
    'classes_body' => '',
    'classes_brand' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_topnav' => 'navbar-white navbar-light',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    */
    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_nav_accordion' => true,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    */
    'use_route_url' => true,

    'dashboard_url' => 'admin.dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => false,
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | MENU ADMIN
    |--------------------------------------------------------------------------
    */
    'menu' => [

        // ===== DASHBOARD =====
        [
            'text' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
        ],

        ['header' => 'GESTION'],

        // ===== CLIENTS =====
        [
            'text' => 'Clients',
            'icon' => 'fas fa-fw fa-users',
            'submenu' => [
                [
                    'text' => 'Liste des clients',
                    'route' => 'clients.index',
                ],
                [
                    'text' => 'Ajouter client',
                    'route' => 'clients.create',
                ],
            ],
        ],

        // ===== CATEGORIES =====
        [
            'text' => 'Catégories',
            'icon' => 'fas fa-fw fa-tags',
            'submenu' => [
                [
                    'text' => 'Liste des catégories',
                    'route' => 'categories.index',
                ],
                [
                    'text' => 'Ajouter catégorie',
                    'route' => 'categories.create',
                ],
            ],
        ],

        // ===== PRODUITS =====
        [
            'text' => 'Produits',
            'icon' => 'fas fa-fw fa-box',
            'submenu' => [
                [
                    'text' => 'Liste des produits',
                    'route' => 'produits.index',
                ],
                [
                    'text' => 'Ajouter produit',
                    'route' => 'produits.create',
                ],
            ],
        ],

        ['header' => 'BOUTIQUE'],

        // ===== SHOP =====
        [
            'text' => 'Boutique',
            'route' => 'shop.produits',
            'icon' => 'fas fa-fw fa-store',
        ],
        [
            'text' => 'Panier',
            'route' => 'shop.panier',
            'icon' => 'fas fa-fw fa-shopping-cart',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    */
    'filters' => [
    JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
    JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
    JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
    JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
],


    /*
    |--------------------------------------------------------------------------
    | Plugins
    |--------------------------------------------------------------------------
    */
    'plugins' => [

        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css',
                ],
            ],
        ],

        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    */
    'livewire' => false,
];
