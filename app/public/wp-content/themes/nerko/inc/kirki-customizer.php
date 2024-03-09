<?php
/**
 * nerko customizer
 *
 * @package nerko
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function nerko_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'nerko_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Nerko Customizer', 'nerko' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'nerko_default_setting', [
        'title'       => esc_html__( 'Nerko Default Setting', 'nerko' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'header_right_setting', [
        'title'       => esc_html__( 'Header Right Setting', 'nerko' ),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'header_modal_setting', [
        'title'       => esc_html__( 'Wallet Popup Setting', 'nerko' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'mobile_menu_setting', [
        'title'       => esc_html__( 'Mobile Menu Setting', 'nerko' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'section_header_logo', [
        'title'       => esc_html__( 'Header Setting', 'nerko' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'nerko' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'nerko' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'nerko' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'nerko' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'nerko' ),
        'description' => '',
        'priority'    => 19,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'typo_setting', [
        'title'       => esc_html__( 'Typography Setting', 'nerko' ),
        'description' => '',
        'priority'    => 20,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );

    $wp_customize->add_section( 'slug_setting', [
        'title'       => esc_html__( 'Slug Settings', 'nerko' ),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'nerko_customizer',
    ] );
}

add_action( 'customize_register', 'nerko_customizer_panels_sections' );


/*
Theme Default Settings
*/
function _nerko_default_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_preloader',
        'label'    => esc_html__( 'Preloader ON/OFF', 'nerko' ),
        'section'  => 'nerko_default_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_mode_trigger',
        'label'    => esc_html__( 'Dark & Light Switcher', 'nerko' ),
        'section'  => 'nerko_default_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_default_dark',
        'label'    => esc_html__( 'Set Default Dark Mode', 'nerko' ),
        'section'  => 'nerko_default_setting',
        'default'  => '0',
        'priority' => 11,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_nerko_default_fields' );


/*
Header Right Settings
*/
function _header_right_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_header_right',
        'label'    => esc_html__( 'Show Header Right', 'nerko' ),
        'section'  => 'header_right_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_header_social',
        'label'    => esc_html__( 'Show Header Social', 'nerko' ),
        'section'  => 'header_right_setting',
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_header_right',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_header_twitter_url',
        'label'    => esc_html__( 'Twitter URL', 'nerko' ),
        'section'  => 'header_right_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__( '#', 'nerko' ),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_header_discord_url',
        'label'    => esc_html__( 'Discord URL', 'nerko' ),
        'section'  => 'header_right_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__( '#', 'nerko' ),
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_header_instagram_url',
        'label'    => esc_html__( 'Instagram URL', 'nerko' ),
        'section'  => 'header_right_setting',
        'description' => esc_html__( 'This works with header style 3', 'nerko' ),
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__( '#', 'nerko' ),
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_heder_btn',
        'label'    => esc_html__( 'Show Header Button', 'nerko' ),
        'section'  => 'header_right_setting',
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'nerko_show_header_right',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_heder_btn_text',
        'label'    => esc_html__( 'Header Button Text', 'nerko' ),
        'section'  => 'header_right_setting',
        'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_header_social',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'nerko_show_heder_btn',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__( 'Connect wallet', 'nerko' ),
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_right_fields' );


/*
Wallet Modal Settings
*/
function _wallet_modal_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_popup_modal',
        'label'    => esc_html__( 'Show Popup Modal', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => 0,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_modal_title',
        'label'    => esc_html__( 'Wallet Title Text', 'nerko' ),
        'section'  => 'header_modal_setting',
        'priority' => 11,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__( 'Connect Wallet', 'nerko' ),
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'nerko_modal_paragraph',
        'label'    => esc_html__( 'Wallet Paragraph Text', 'nerko' ),
        'section'  => 'header_modal_setting',
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__( 'Please select a wallet to connect for start Minting your NFTs', 'nerko' ),
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_metamask',
        'label'    => esc_html__( 'Show MetaMask', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => 1,
        'priority' => 13,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_metamask_url',
        'label'    => esc_html__( 'MetaMask URL', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 13,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'nerko_show_metamask',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_bitgo',
        'label'    => esc_html__( 'Show BitGo', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => 0,
        'priority' => 13,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_bitgo_url',
        'label'    => esc_html__( 'BitGo URL', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 13,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'nerko_show_bitgo',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_trustWallet',
        'label'    => esc_html__( 'Show Trust Wallet', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => 0,
        'priority' => 13,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_trustWallet_url',
        'label'    => esc_html__( 'Trust Wallet URL', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 13,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'nerko_show_trustWallet',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_coinbase',
        'label'    => esc_html__( 'Show Coinbase', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => 0,
        'priority' => 13,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_coinbase_url',
        'label'    => esc_html__( 'Coinbase URL', 'nerko' ),
        'section'  => 'header_modal_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 13,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
            [
                'setting'  => 'nerko_show_coinbase',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'nerko_modal_privacy',
        'label'    => esc_html__( 'Modal Bottom Text', 'nerko' ),
        'section'  => 'header_modal_setting',
        'priority' => 14,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_popup_modal',
                'operator' => '===',
                'value'    => true,
            ],
        ],
        'default'  => esc_html__( 'By connecting your wallet, you agree to our Terms of Service and our Privacy Policy.', 'nerko' ),
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_wallet_modal_fields' );


/*
Mobile Menu Settings
*/
function _mobile_menu_fields( $fields ) {

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'mobile_logo',
        'label'       => esc_html__( 'Mobile Menu Logo Dark', 'nerko' ),
        'description' => esc_html__( 'Upload Your Logo.', 'nerko' ),
        'section'     => 'mobile_menu_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.svg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'mobile_white_logo',
        'label'       => esc_html__( 'Mobile Menu Logo White', 'nerko' ),
        'description' => esc_html__( 'Upload Your Logo.', 'nerko' ),
        'section'     => 'mobile_menu_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/secondary_logo.svg',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_mobile_social',
        'label'    => esc_html__( 'Show Mobile Menu Social', 'nerko' ),
        'section'  => 'mobile_menu_setting',
        'default'  => 0,
        'priority' => 12,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    // Mobile section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_mobile_fb_url',
        'label'    => esc_html__( 'Facebook URL', 'nerko' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_mobile_twitter_url',
        'label'    => esc_html__( 'Twitter URL', 'nerko' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_mobile_instagram_url',
        'label'    => esc_html__( 'Instagram URL', 'nerko' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_mobile_discord_url',
        'label'    => esc_html__( 'Discord URL', 'nerko' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_mobile_telegram_url',
        'label'    => esc_html__( 'Telegram URL', 'nerko' ),
        'section'  => 'mobile_menu_setting',
        'default'  => esc_html__( '#', 'nerko' ),
        'priority' => 12,
        'active_callback'  => [
            [
                'setting'  => 'nerko_show_mobile_social',
                'operator' => '===',
                'value'    => true,
            ],
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_mobile_menu_fields' );


/*
Header Settings
 */
function _header_header_fields( $fields ) {

    // Sticky Header
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_sticky_header',
        'label'    => esc_html__( 'Show Sticky Header', 'nerko' ),
        'section'  => 'section_header_logo',
        'default'  => 0,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'nerko' ),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__( 'Select an option...', 'nerko' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3' => get_template_directory_uri() . '/inc/img/header/header-3.png',
            'header-style-4' => get_template_directory_uri() . '/inc/img/header/header-4.png',
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'nerko' ),
        'description' => esc_html__( 'Upload Your Logo', 'nerko' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.svg',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'secondary_logo',
        'label'       => esc_html__( 'Header Secondary Logo', 'nerko' ),
        'description' => esc_html__( 'Upload Your Logo', 'nerko' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/secondary_logo.svg',
    ];

    $fields[] = [
        'type'        => 'dimension',
        'settings'    => 'logo_size_adjust',
		'label'       => esc_html__( 'Header Logo Size', 'nerko' ),
		'description' => esc_html__( 'Adjust your logo size with px', 'nerko' ),
		'section'     => 'section_header_logo',
		'default'     => '120px',
        'choices'     => [
			'accept_unitless' => true,
		],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );

/*
_header_page_title_fields
 */
function _header_page_title_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_info_switch',
        'label'    => esc_html__( 'Breadcrumb Info switch', 'nerko' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_blog_btn_switch',
        'label'    => esc_html__( 'Blog Button ON/OFF', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta ON/OFF', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_blog_author',
        'label'    => esc_html__( 'Blog Author Meta ON/OFF', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_blog_date',
        'label'    => esc_html__( 'Blog Date Meta ON/OFF', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta ON/OFF', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'nerko_show_blog_share',
        'label'    => esc_html__( 'Show Blog Share', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'nerko' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'nerko' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'nerko' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'nerko' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'nerko' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'nerko' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'nerko' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'nerko' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__( 'Widget Number 4', 'nerko' ),
            '3' => esc_html__( 'Widget Number 3', 'nerko' ),
            '2' => esc_html__( 'Widget Number 2', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'show_copyright_menu',
        'label'    => esc_html__( 'Show Copyright Menu', 'nerko' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'nerko' ),
            'off' => esc_html__( 'Disable', 'nerko' ),
        ],
    ];

    $fields[] = [
        'type'     => 'repeater',
		'settings' => 'copyright_menu_repeater',
		'label'    => esc_html__( 'Copyright Menu', 'nerko' ),
		'section'  => 'footer_setting',
		'priority' => 10,
        'active_callback'  => [
            [
                'setting'  => 'show_copyright_menu',
                'operator' => '===',
                'value'    => true,
            ],
        ],
		'default'  => [
			[
				'link_text'   => esc_html__( 'Privacy policy', 'nerko' ),
				'link_url'    => '#',
			],
			[
				'link_text'   => esc_html__( 'Terms of Use', 'nerko' ),
				'link_url'    => '#',
			],
		],
		'fields'   => [
			'link_text'   => [
				'type'        => 'text',
				'label'       => esc_html__( 'Item Name', 'nerko' ),
				'description' => esc_html__( 'Enter your menu item name', 'nerko' ),
				'default'     => '',
			],
			'link_url'    => [
				'type'        => 'text',
				'label'       => esc_html__( 'Link URL', 'nerko' ),
				'description' => esc_html__( 'Enter your menu item link', 'nerko' ),
				'default'     => '',
			],
		],
	];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_copyright',
        'label'    => esc_html__( 'CopyRight', 'nerko' ),
        'section'  => 'footer_setting',
        'default'  => wp_kses_post( 'Copyright © 2022 Nerko All Rights Reserved.', 'nerko' ),
        'priority' => 11,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );


// color
function nerko_color_fields( $fields ) {
    // Color Settings
    $fields[] = [
        'label'       => __( 'Primary Color', 'nerko' ),
        'settings'    => 'nerko_primary_color',
        'type'        => 'color',
        'section'     => 'color_setting',
        'default'     => '#741ff5',
        'description' => esc_html__( 'This is a Theme color control.', 'nerko' ),
        'priority'    => 10,
    ];

    // Color Settings
    $fields[] = [
        'label'       => __( 'Secondary Color', 'nerko' ),
        'type'        => 'color',
        'settings'    => 'nerko_secondary_color',
        'section'     => 'color_setting',
        'default'     => '#e348ff',
        'description' => esc_html__( 'This is a Primary color control.', 'nerko' ),
        'priority'    => 10,
    ];

     // Color Settings
    $fields[] = [
        'label'       => __( 'Gradient Left Color', 'nerko' ),
        'type'        => 'color',
        'settings'    => 'nerko_gradient_color_1',
        'section'     => 'color_setting',
        'default'     => '#2600fc',
        'description' => esc_html__( 'This is a Secondary color control.', 'nerko' ),
        'priority'    => 10,
    ];

     // Color Settings
     $fields[] = [
        'label'       => __( 'Gradient Right Color', 'nerko' ),
        'type'        => 'color',
        'settings'    => 'nerko_gradient_color_2',
        'section'     => 'color_setting',
        'default'     => '#ff00ea',
        'description' => esc_html__( 'This is a Secondary color 2 control.', 'nerko' ),
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', 'nerko_color_fields' );

// 404
function nerko_404_fields( $fields ) {
    // 404 settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_error_text',
        'label'    => esc_html__( '404 Text', 'nerko' ),
        'section'  => '404_page',
        'default'  => esc_html__( '404', 'nerko' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'nerko_error_title',
        'label'    => esc_html__( 'Not Found Title', 'nerko' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Sorry, the page you are looking for could not be found', 'nerko' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'nerko' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'nerko' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'nerko_404_fields' );


/**
 * Added Fields
 */
function nerko_typo_fields( $fields ) {
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__( 'Body Font', 'nerko' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__( 'Heading h1 Fonts', 'nerko' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__( 'Heading h2 Fonts', 'nerko' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__( 'Heading h3 Fonts', 'nerko' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__( 'Heading h4 Fonts', 'nerko' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__( 'Heading h5 Fonts', 'nerko' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__( 'Heading h6 Fonts', 'nerko' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'nerko_typo_fields' );


/**
 * Added Fields
 */
function nerko_slug_setting( $fields ) {
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_ev_slug',
        'label'    => esc_html__( 'Event Slug', 'nerko' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourevent', 'nerko' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'nerko_port_slug',
        'label'    => esc_html__( 'Portfolio Slug', 'nerko' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourportfolio', 'nerko' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'nerko_slug_setting' );


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function NERKO_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'nerko' ) ) {
        $value = Kirki::get_option( nerko_get_theme(), $name );
    }

    return apply_filters( 'NERKO_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function nerko_get_theme() {
    return 'nerko';
}