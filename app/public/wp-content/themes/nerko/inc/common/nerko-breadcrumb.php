<?php
/**
 * Breadcrumbs for nerko theme.
 *
 * @package     nerko
 * @author      ThemeGenix
 * @copyright   Copyright (c) 2022, ThemeGenix
 * @link        https://www.themepure.net
 * @since       nerko 1.0.0
 */


function nerko_breadcrumb_func() {
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','nerko'));
        $breadcrumb_class = 'home_front_page';
    }
    elseif ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','nerko'));
        $breadcrumb_show = 0;
    }
    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }
    elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
    }
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'nerko' ) . get_search_query();
    }
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'nerko' );
    }
    elseif ( is_archive() ) {
        $title = get_the_archive_title();
    }
    else {
        $title = get_the_title();
    }

    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) {
        $_id = $post->ID;
    }
    elseif ( function_exists("is_shop") AND is_shop()  ) {
        $_id = wc_get_page_id('shop');
    }
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
    }

    $is_breadcrumb = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_breadcrumb', $_id ) : '';
    if( !empty($_GET['s']) ) {
      $is_breadcrumb = null;
    }

    if ( empty( $is_breadcrumb ) && $breadcrumb_show == 1 ) {
        // get_theme_mod
        $breadcrumb_info_switch = get_theme_mod( 'breadcrumb_info_switch', true );
    ?>

        <div class="banner__background-wrap z-index-minus">
            <div class="background" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/bg/gradient_bg01.png"></div>
        </div>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area <?php print esc_attr( $breadcrumb_class );?>">
            <div class="container">
                <div class="row justify-content-center">
                    <?php if (!empty($breadcrumb_info_switch)) : ?>
                        <div class="col-lg-12">
                            <div class="breadcrumb__content">
                                <h2 class="title"><?php echo wp_kses_post( $title ); ?></h2>
                                <nav aria-label="breadcrumb" class="breadcrumb">
                                    <?php if(function_exists('bcn_display')) {
                                        bcn_display();
                                    } ?>
                                </nav>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

    <?php
    }
}

add_action( 'nerko_before_main_content', 'nerko_breadcrumb_func' );