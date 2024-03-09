<?php

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nerko
*/

$show_copyright_menu = get_theme_mod( 'show_copyright_menu', false );
$defaults_menu = [
    [
        'link_text' => esc_html__( 'Terms of Use', 'nerko' ),
        'link_url'  => '#',
    ],
    [
        'link_text' => esc_html__( 'Privacy policy', 'nerko' ),
        'link_url'  => '#',
    ],
];
$copyright_menu_repeater = get_theme_mod('copyright_menu_repeater' , $defaults_menu);
$nerko_copyright_center = $show_copyright_menu ? 'col-md-6' : 'col-12 text-center';

// Footer Columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-' . $num ) ) {
        $footer_columns++;
    }
}

switch ( $footer_columns ) {
case '1':
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-lg-4 col-md-6';
    $footer_class[2] = 'col-lg-4 col-md-6 col-sm-6';
    $footer_class[3] = 'col-lg-4 col-md-6 col-sm-6';
    break;
case '4':
    $footer_class[1] = 'col-lg-4 col-md-6';
    $footer_class[2] = 'col-lg-3 col-md-6';
    $footer_class[3] = 'col-lg-2 col-sm-6';
    $footer_class[4] = 'col-xl-2 col-lg-3 col-sm-6';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-4 col-sm-6';
    break;
}

?>


<!-- footer-area -->
<footer class="footer-area footer-style-default">

    <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4') ): ?>
    <div class="footer__top-wrapper">
        <div class="container">
            <div class="row justify-content-between">
                <?php
                    if ( $footer_columns < 4 ) {
                    print '<div class="col-lg-4 col-md-6">';
                    dynamic_sidebar( 'footer-1' );
                    print '</div>';

                    print '<div class="col-lg-3 col-md-6">';
                    dynamic_sidebar( 'footer-2' );
                    print '</div>';

                    print '<div class="col-lg-2 col-sm-6">';
                    dynamic_sidebar( 'footer-3' );
                    print '</div>';

                    print '<div class="col-xl-2 col-lg-3 col-sm-6">';
                    dynamic_sidebar( 'footer-4' );
                    print '</div>';
                    } else {
                        for ( $num = 1; $num <= $footer_columns; $num++ ) {
                            if ( !is_active_sidebar( 'footer-' . $num ) ) {
                                continue;
                            }
                            print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                            dynamic_sidebar( 'footer-' . $num );
                            print '</div>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="copyright__wrapper-default">
        <div class="container">
            <div class="row align-items-center">
                <div class="<?php echo esc_attr( $nerko_copyright_center ); ?>">
                    <div class="copyright__text">
                        <p><?php print nerko_copyright_text(); ?></p>
                    </div>
                </div>

                <?php if (!empty( $show_copyright_menu )) : ?>
                <div class="col-md-6">
                    <div class="copyright__menu">
                        <ul class="list-wrap">
                            <?php foreach ( $copyright_menu_repeater as $item ) : ?>
                                <li><a href="<?php echo esc_url($item['link_url']); ?>"><?php echo esc_html($item['link_text']); ?></a></li>
                            <?php endforeach; ?>
                            <li class="backTop">
                                <a href="javascript:void(0)" class="scroll-to-target" data-target="html"><i class="flaticon-arrowhead-up"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
<!-- footer-area-end -->