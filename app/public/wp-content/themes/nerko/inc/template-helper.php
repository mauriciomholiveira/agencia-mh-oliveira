<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package nerko
 */


/**
 *
 * Nerko Header
 */

function nerko_check_header() {
    $nerko_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $nerko_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

    if ( $nerko_header_style == 'header-style-1' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-1' );
    }
    elseif ( $nerko_header_style == 'header-style-2' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-2' );
    }
    elseif ( $nerko_header_style == 'header-style-3' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-3' );
    }
    elseif ( $nerko_header_style == 'header-style-4' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-4' );
    }
    else {

        /** Default Header Style **/
        if ( $nerko_default_header_style == 'header-style-2' ) {
            get_template_part( 'template-parts/header/header-2' );
        }
        elseif ( $nerko_default_header_style == 'header-style-3' ) {
            get_template_part( 'template-parts/header/header-3' );
        }
        elseif ( $nerko_default_header_style == 'header-style-4' ) {
            get_template_part( 'template-parts/header/header-4' );
        }
        else {
            get_template_part( 'template-parts/header/header-1' );
        }
    }

}
add_action( 'nerko_header_style', 'nerko_check_header', 10 );


/**
 * [nerko_header_lang description]
 * @return [type] [description]
 */
function nerko_header_lang_default() {
    $nerko_header_lang = get_theme_mod( 'nerko_header_lang', false );
    if ( $nerko_header_lang ): ?>

    <ul>
        <li><a href="javascript:void(0)" class="lang__btn"><?php print esc_html__( 'English', 'nerko' );?> <i class="fa-light fa-angle-down"></i></a>
        <?php do_action( 'nerko_language' );?>
        </li>
    </ul>

    <?php endif;?>
<?php
}

/**
 * [nerko_language_list description]
 * @return [type] [description]
 */
function _nerko_language( $mar ) {
    return $mar;
}
function nerko_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="lang-list">';
        $mar .= '<li><a href="#">' . esc_html__( 'IND', 'nerko' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'SPA', 'nerko' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'GRE', 'nerko' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'CIN', 'nerko' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _nerko_language( $mar );
}
add_action( 'nerko_language', 'nerko_language_list' );


// Header Logo
function nerko_header_logo() { ?>
      <?php
        $nerko_logo_on = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : NULL;
        $nerko_logo = get_template_directory_uri() . '/assets/img/logo/logo.svg';
        $nerko_logo_black = get_template_directory_uri() . '/assets/img/logo/secondary_logo.svg';

        $nerko_site_logo = get_theme_mod( 'logo', $nerko_logo );
        $nerko_secondary_logo = get_theme_mod( 'secondary_logo', $nerko_logo_black );
      ?>

      <?php if ( !empty( $nerko_logo_on ) ) : ?>
         <a class="secondary-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $nerko_secondary_logo );?>" height="auto" style="max-width: <?php echo get_theme_mod( 'logo_size_adjust', '120px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'nerko' );?>" />
         </a>
      <?php else : ?>
         <a class="light-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $nerko_site_logo );?>" height="auto" style="max-width: <?php echo get_theme_mod( 'logo_size_adjust', '120px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'nerko' );?>" />
         </a>
         <a class="dark-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $nerko_secondary_logo );?>" height="auto" style="max-width: <?php echo get_theme_mod( 'logo_size_adjust', '120px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'nerko' );?>" />
         </a>
      <?php endif; ?>
   <?php
}

// Header Sticky Logo
function nerko_header_sticky_logo() {?>
    <?php
        $nerko_logo_black = get_template_directory_uri() . '/assets/img/logo/secondary_logo.svg';
        $nerko_secondary_logo = get_theme_mod( 'secondary_logo', $nerko_logo_black );
    ?>
      <a class="sticky-logo" href="<?php print esc_url( home_url( '/' ) );?>">
          <img src="<?php print esc_url( $nerko_secondary_logo );?>" alt="<?php print esc_attr__( 'Logo', 'nerko' );?>" />
      </a>
    <?php
}

// Mobile Menu Logo
function nerko_mobile_logo() {

    $mobile_menu_white_logo = get_template_directory_uri() . '/assets/img/logo/secondary_logo.svg';
    $mobile_menu_logo = get_template_directory_uri() . '/assets/img/logo/logo.svg';
    $mobile_white_logo = get_theme_mod('mobile_white_logo', $mobile_menu_white_logo);
    $mobile_logo = get_theme_mod('mobile_logo', $mobile_menu_logo);

    ?>

    <a class="light-logo" href="<?php print esc_url( home_url( '/' ) ); ?>">
        <img src="<?php print esc_url( $mobile_logo ); ?>" height="auto" style="max-width: <?php echo get_theme_mod( 'logo_size_adjust', '120px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'nerko' );?>" />
    </a>

    <a class="dark-logo" href="<?php print esc_url( home_url( '/' ) ); ?>">
        <img src="<?php print esc_url( $mobile_white_logo ); ?>" height="auto" style="max-width: <?php echo get_theme_mod( 'logo_size_adjust', '120px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'nerko' );?>" />
    </a>

<?php }


/**
 * [nerko_header_social_profiles description]
 * @return [type] [description]
 */
function nerko_header_social_profiles() {
    $nerko_header_fb_url = get_theme_mod( 'nerko_header_fb_url', __( '#', 'nerko' ) );
    $nerko_header_twitter_url = get_theme_mod( 'nerko_header_twitter_url', __( '#', 'nerko' ) );
    $nerko_header_linkedin_url = get_theme_mod( 'nerko_header_linkedin_url', __( '#', 'nerko' ) );
    ?>
    <ul>
        <?php if ( !empty( $nerko_header_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $nerko_header_fb_url );?>"><span><i class="flaticon-facebook"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $nerko_header_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $nerko_header_twitter_url );?>"><span><i class="flaticon-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $nerko_header_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $nerko_header_linkedin_url );?>"><span><i class="flaticon-linkedin"></i></span></a></li>
        <?php endif;?>
    </ul>

<?php
}

function nerko_footer_social_profiles() {
    $nerko_footer_fb_url = get_theme_mod( 'nerko_footer_fb_url', __( '#', 'nerko' ) );
    $nerko_footer_twitter_url = get_theme_mod( 'nerko_footer_twitter_url', __( '#', 'nerko' ) );
    $nerko_footer_vimeo_url = get_theme_mod( 'nerko_footer_vimeo_url', __( '#', 'nerko' ) );
    $nerko_footer_youtube_url = get_theme_mod( 'nerko_footer_youtube_url', __( '#', 'nerko' ) );
    ?>

        <ul>
        <?php if ( !empty( $nerko_footer_fb_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $nerko_footer_fb_url );?>">
                    <i class="fab fa-facebook-square"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $nerko_footer_twitter_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $nerko_footer_twitter_url );?>">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $nerko_footer_vimeo_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $nerko_footer_vimeo_url );?>">
                    <i class="fab fa-vimeo-v"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $nerko_footer_youtube_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $nerko_footer_youtube_url );?>">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif;?>
        </ul>
<?php
}

/**
 * [nerko_mobile_social_profiles description]
 * @return [type] [description]
 */
function nerko_mobile_social_profiles() {
    $nerko_mobile_fb_url           = get_theme_mod('nerko_mobile_fb_url', __('#','nerko'));
    $nerko_mobile_twitter_url      = get_theme_mod('nerko_mobile_twitter_url', __('#','nerko'));
    $nerko_mobile_instagram_url    = get_theme_mod('nerko_mobile_instagram_url', __('#','nerko'));
    $nerko_mobile_discord_url     = get_theme_mod('nerko_mobile_discord_url', __('#','nerko'));
    $nerko_mobile_telegram_url      = get_theme_mod('nerko_mobile_telegram_url', __('#','nerko'));
    ?>

    <ul class="clearfix">
        <?php if (!empty($nerko_mobile_fb_url)): ?>
        <li class="facebook">
            <a href="<?php print esc_url($nerko_mobile_fb_url); ?>"><i class="fab fa-facebook-f"></i></a>
        </li>
        <?php endif; ?>

        <?php if (!empty($nerko_mobile_twitter_url)): ?>
        <li class="twitter">
            <a href="<?php print esc_url($nerko_mobile_twitter_url); ?>"><i class="fab fa-twitter"></i></a>
        </li>
        <?php endif; ?>

        <?php if (!empty($nerko_mobile_instagram_url)): ?>
        <li class="instagram">
            <a href="<?php print esc_url($nerko_mobile_instagram_url); ?>"><i class="fab fa-instagram"></i></a>
        </li>
        <?php endif; ?>

        <?php if (!empty($nerko_mobile_discord_url)): ?>
        <li class="discord">
            <a href="<?php print esc_url($nerko_mobile_discord_url); ?>"><i class="fab fa-discord"></i></a>
        </li>
        <?php endif; ?>

        <?php if (!empty($nerko_mobile_telegram_url)): ?>
        <li class="telegram">
            <a href="<?php print esc_url($nerko_mobile_telegram_url); ?>"><i class="fab fa-telegram-plane"></i></a>
        </li>
        <?php endif; ?>
    </ul>

<?php
}


/**
 * [nerko_header_menu description]
 * @return [type] [description]
 */
function nerko_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'navigation',
            'container'      => '',
            'fallback_cb'    => 'Nerko_Navwalker_Class::fallback',
        ] );
    ?>
    <?php
}


/**
 * [nerko_blog_menu description]
 * @return [type] [description]
 */
function nerko_blog_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'inner-menu',
            'menu_class'     => 'navigation',
            'container'      => '',
            'fallback_cb'    => 'Nerko_Navwalker_Class::fallback',
        ] );
    ?>
    <?php
}

/**
 * [nerko_header_menu description]
 * @return [type] [description]
 */
function nerko_mobile_menu() {
    ?>
    <?php
        $nerko_menu = wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'navigation',
            'container'      => '',
            'fallback_cb'    => false,
            'echo'           => false,
        ] );

    $nerko_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $nerko_menu );
        echo wp_kses_post( $nerko_menu );
    ?>
    <?php
}

/**
 * [nerko_blog_mobile_menu description]
 * @return [type] [description]
 */
function nerko_blog_mobile_menu() {
    ?>
    <?php
        $nerko_menu = wp_nav_menu( [
            'theme_location' => 'inner-menu',
            'menu_class'     => 'navigation',
            'container'      => '',
            'fallback_cb'    => false,
            'echo'           => false,
        ] );

    $nerko_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $nerko_menu );
        echo wp_kses_post( $nerko_menu );
    ?>
    <?php
}

/**
 * [nerko_search_menu description]
 * @return [type] [description]
 */
function nerko_header_search_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'header-search-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'Nerko_Navwalker_Class::fallback',
            'walker'         => new Nerko_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [nerko_footer_menu description]
 * @return [type] [description]
 */
function nerko_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'navigation',
        'container'      => '',
        'fallback_cb'    => 'Nerko_Navwalker_Class::fallback',
        'walker'         => new Nerko_Navwalker_Class,
    ] );
}


/**
 * [nerko_category_menu description]
 * @return [type] [description]
 */
function nerko_category_menu() {
    wp_nav_menu( [
        'theme_location' => 'category-menu',
        'menu_class'     => 'cat-submenu m-0',
        'container'      => '',
        'fallback_cb'    => 'Nerko_Navwalker_Class::fallback',
        'walker'         => new Nerko_Navwalker_Class,
    ] );
}

/**
 *
 * nerko footer
 */
add_action( 'nerko_footer_style', 'nerko_check_footer', 10 );

function nerko_check_footer() {

    $footer_show = 1;
    $is_footer = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_footer') : '';
    if( !empty($_GET['s']) ) {
      $is_footer = null;
    }

    if ( empty( $is_footer ) && $footer_show == 1 ) {
        $nerko_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
        $nerko_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

        get_template_part( 'template-parts/footer/footer-1' );
    }

}

// nerko_copyright_text
function nerko_copyright_text() {
   print get_theme_mod( 'nerko_copyright', wp_kses_post( 'Copyright © 2022 Nerko All Rights Reserved.', 'nerko' ) );
}


/**
 *
 * pagination
 */
if ( !function_exists( 'nerko_pagination' ) ) {

    function _nerko_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function nerko_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul class="pagination">';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li class="page-item">' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _nerko_pagi_callback( $pagi );
    }
}


// theme color
function nerko_custom_color() {

    $color_code = get_theme_mod( 'nerko_primary_color', '#741ff5' );
    wp_enqueue_style( 'nerko-custom', NERKO_THEME_CSS_DIR . 'nerko-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tg-theme-primary: " . $color_code . "}";

        wp_add_inline_style( 'nerko-custom', $custom_css );
    }

    $color_code = get_theme_mod( 'nerko_secondary_color', '#e348ff' );
    wp_enqueue_style( 'nerko-custom', NERKO_THEME_CSS_DIR . 'nerko-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tg-theme-secondary: " . $color_code . "}";

        wp_add_inline_style( 'nerko-custom', $custom_css );
    }

    $color_code = get_theme_mod( 'nerko_gradient_color_1', '#2600fc' );
    wp_enqueue_style( 'nerko-custom', NERKO_THEME_CSS_DIR . 'nerko-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tg-gradient-1: " . $color_code . "}";

        wp_add_inline_style( 'nerko-custom', $custom_css );
    }

    $color_code = get_theme_mod( 'nerko_gradient_color_2', '#ff00ea' );
    wp_enqueue_style( 'nerko-custom', NERKO_THEME_CSS_DIR . 'nerko-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tg-gradient-2: " . $color_code . "}";

        wp_add_inline_style( 'nerko-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'nerko_custom_color' );


// nerko_kses_intermediate
function nerko_kses_intermediate( $string = '' ) {
    return wp_kses( $string, nerko_get_allowed_html_tags( 'intermediate' ) );
}

function nerko_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function nerko_kses($raw){

   $allowed_tags = array(
      'a'      => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'   => array(
         'title' => array(),
      ),
      'b'    => array(),
      'blockquote'   => array(
         'cite' => array(),
      ),
      'cite'   => array(
         'title' => array(),
      ),
      'code'  => array(),
      'del'   => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'     => array(),
      'div'    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'   => array(),
      'dt'   => array(),
      'em'   => array(),
      'h1'   => array(),
      'h2'   => array(),
      'h3'   => array(),
      'h4'   => array(),
      'h5'   => array(),
      'h6'   => array(),
      'i'    => array(
        'class' => array(),
      ),
      'img'   => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'   => array(
         'class' => array(),
      ),
      'ol'   => array(
         'class' => array(),
      ),
      'p'    => array(
         'class' => array(),
      ),
      'q'    => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'  => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'   => array(
         'width'        => array(),
         'height'       => array(),
         'scrolling'    => array(),
         'frameborder'  => array(),
         'allow'        => array(),
         'src'          => array(),
      ),
      'strike'  => array(),
      'br'      => array(),
      'strong'    => array(),
      'data-wow-duration'   => array(),
      'data-wow-delay'   => array(),
      'data-wallpaper-options'  => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'   => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}