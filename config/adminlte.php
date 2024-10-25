<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'SGCCS ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>SGCCS</b>',
    //'logo_img' => 'img/gamea_logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/LOGOFIN.jpg',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 100,
            'height' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/LOGOFIN.jpg',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 100,
            'height' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-dark',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        // [
        //     'text' => 'pages',
        //     'url' => 'admin/pages',
        //     'icon' => 'far fa-fw fa-file',
        //     'label' => 4,
        //     'label_color' => 'success',
        // ],
        ['header' => ' . . . . . . . A C C I O N E S '],
        // [
        //     'text' => 'PERFIL',
        //     'url' => 'roles/show',
        //     'icon' => 'fas fa-fw fa-user',
        //     'can' => 'roles.show',
        // ],



        // [
        //     'text' => 'change_password',
        //     'url' => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        [
            'text' => 'ESTADISTICAS Y REPORTES',
            'url' => 'reportes/index',
            'icon' => 'fas fa-fw fa-signal',
            // 'can' => 'reportes.index',
        ],
        [
            'text' => 'BÚSQUEDA',
            'url' => 'busqueda',
            'icon' => 'fas fa-search', //logo del icono
            //'can' => 'busqueda.index',//Puede usar el usuario si tienes creado el controlador
        ],
        
        [
            'text' => 'CASOS',
            'icon' => 'fas fa-gavel',
            'submenu' => [
                [
                    'text' => 'Crear caso',
                    'icon' => 'fas fa-gavel',
                    'url' => 'casos/create',
                    'can' => 'casos.create',
                ],

                [
                    'text' => 'Listar caso',
                    'icon' => 'fas fa-list',
                    'url' => 'casos',
                    'can' => 'casos.index',
                ],

                [
                    'text' => 'Crear tipo de caso',
                    'icon' => 'fas fa-book-dead',
                    'url' => 'tipo_casos/create',
                    'can' => 'tipo_casos.create',
                ],
                [
                    'text' => 'Listar tipo de caso',
                    'icon' => 'fas fa-list',
                    'url' => 'tipo_casos',
                    'can' => 'tipo_casos.index',
                ],

            
            ],
        
        ],
              [
                'text' => 'ACTUADOS',
                'icon' => 'fas fa-users',
    
    
                'submenu' => [
                     
                [
                    'text' => 'Listar Actuados',
                    'icon' => 'fas fa-list',
                    'url' => 'administrador/actuas',
                    // 'can' => 'actuas.index', 
                ],
                [
                    'text' => 'Crear Actuados',
                    'icon' => 'fas fa-plus',
                    'url' => 'administrador/actuas/create',
                    // 'can' => 'actuas.create',
                ],
                [
                    'text' => 'Listar Caso Actuados',
                    'icon' => 'fas fa-list',
                    'url' => 'administrador/caso_actuados',
                    // 'can' => 'actuas.index', 
                ],


            ],
        ],
        

        [
            'text' => 'SUMARIANTES',
            'icon' => 'fas fa-users',
            'submenu' => [

                [
                    'text' => 'Registrar sumario',
                    'icon' => 'fas fa-user-plus',
                    'url' => 'personas/create',
                    'can' => 'personas.create',
                ],
                [
                    'text' => 'Listar sumario',
                    'icon' => 'fas fa-list',
                    'url' => 'personas',
                    'can' => 'personas.index',
                ],
                [
                    'text' => 'Listar sumario-Casos',
                    'icon' => 'fas fa-list',
                    'url' => 'administrador/caso_personas',
                    //'can' => 'personas.index',
                ],
            ],
        ],
        
                [
                    'text' => 'TIPOS DE SUMARIOS',
                    'icon' => 'fas fa-portrait',
        
                    'submenu' => [
                
                [
                    'text' => 'Crear tipo de suamrio',
                    'icon' => 'fas fa-user-plus',
                    'url' => 'tipo_personas/create',
                    'can' => 'tipo_personas.create',
                ],
                [
                    'text' => 'Listar tipo de suamrio',
                    'icon' => 'fas fa-list',
                    'url' => 'tipo_personas',
                    'can' => 'tipo_personas.index',
                ],
                [
                    'text' => 'Listar Tipos de Sumario',
                    'icon' => 'fas fa-list',
                    'url' => 'administrador/persona_tipo_personas', // Asegúrate de incluir el prefijo
                    //'can' => 'persona_tipo_personas.index', Descomenta si deseas usar permisos
                ],

            ],
        ],
    
        ///COMIENZO SANCIONS
        [
            'text' => 'SANCIONES',
            'icon' => 'fas fa-portrait',

            'submenu' => [
                [
                    'text' => 'Registrar Sancion',
                    'icon' => 'fas fa-user-plus',
                    'url' => 'administrador/sancions/create',
                    //  'can' => 'users.create',
                ],
                [
                    'text' => 'Listar Sanciones',
                    'icon' => 'fas fa-list',
                    'url' => 'administrador/sancions',
                    // 'can' => 'users.index',
                ],
             
            ],
        ],
        //sanciones ASTA AQUI
        [
            'text' => 'SANCIONAR SUMARIANTES',
            'icon' => 'fas fa-portrait',

            'submenu' => [
                [
                    'text' => 'Agrgar Sancion a Sumariante',
                    'icon' => 'fas fa-list',
                    'url' => 'sancion_personas/create',
                    // 'can' => 'users.index',
                ],
                [
                    'text' => 'Sancionar Sumariante',
                    'icon' => 'fas fa-users',
                   'url' => 'sancion_personas',
                    //  'can' => 'roles.index',
                ],
                // [
                //     'text' => 'Sancionar a muchos',
                //     'icon' => 'fas fa-list',
                //     'url' => 'administrador/sancion_personas/sancionartodos', // Corregido
                //     // 'can' => 'users.index',
                // ],
            ],
        ],

        [
            'header' => ' .  .  . .  .  . U  S  U  A  R  I  O  S ',
            'can'  => 'users.index',
        ],

        [
            'text' => 'GESTION DE USUARIOS',
            'icon' => 'fas fa-portrait',

            'submenu' => [
                [
                    'text' => 'Registrar Usuarios',
                    'icon' => 'fas fa-user-plus',
                    'url' => 'users/create',
                    'can' => 'users.create',
                ],
                [
                    'text' => 'Listar Usuarios',
                    'icon' => 'fas fa-list',
                    'url' => 'users',
                    'can' => 'users.index',
                ],
                [
                    'text' => 'Roles de usuarios',
                    'icon' => 'fas fa-users',
                    'url' => 'roles',
                    'can' => 'roles.index',
                ],
            ],
        ],

        /// te quedaste aqui coneta url con lo vissto no en consunto y luego por partes
        // [
        //     'text'        => 'Usuarios',
        //     'url'         => 'usuarios',
        //     'icon'        => 'fas fa-user',
        //     'style'        => 'fa-primary-color: #188c1f; --fa-secondary-color: #188c1f', //iconos del usuario
        //     //'label'       => 4,
        //     'label_color' => 'success',
        //     'can' => 'users.index',

        // ],

        // ['header' => 'labels'],
        // [
        //     'text' => 'important',
        //     'icon_color' => 'red',
        //     'url' => '#',
        // ],
        // [
        //     'text' => 'warning',
        //     'icon_color' => 'yellow',
        //     'url' => '#',
        // ],
        // [
        //     'text' => 'information',
        //     'icon_color' => 'cyan',
        //     'url' => '#',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
