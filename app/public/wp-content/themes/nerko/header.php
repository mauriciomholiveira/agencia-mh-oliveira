<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nerko
 */
?>

<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php wp_body_open();?>


    <?php

        $darkmode_trigger = get_theme_mod( 'nerko_mode_trigger', false );
        $darkmode_trigger_hide = $darkmode_trigger ? '' : 'd-none';

        $nerko_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
        $nerko_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

        if ( $nerko_header_style == 'header-style-4' && empty($_GET['s']) ) {
            $nerko_gradient_class = $nerko_header_style ? 'blend-soft-light' : '';
        }
        else {

            if ( $nerko_default_header_style == 'header-style-4' ) {
                $nerko_gradient_class = $nerko_default_header_style ? 'blend-soft-light' : '';
            }
            else {
                $nerko_gradient_class = $nerko_default_header_style ? '' : 'blend-soft-light';
            }
        }

    ?>
    <!-- Dark/Light-toggle -->
    <div class="darkmode-trigger <?php echo esc_attr( $darkmode_trigger_hide ); ?>">
        <label class="modeSwitch">
            <input type="checkbox">
            <span class="icon"></span>
        </label>
    </div>
    <!-- Dark/Light-toggle-end -->


    <?php do_action( 'nerko_header_style' );?>


    <!-- main-area -->
   <main class="fix">

    <!-- gradient-position -->
    <div class="gradient-position <?php echo esc_attr( $nerko_gradient_class ); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/others/gradient-circle.svg" style="left: -4%; top: -4%" width="500" alt="<?php echo esc_attr__('Background Circle','nerko') ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/others/gradient-circle.svg" style="right: -4%; bottom: -4%" width="500" alt="<?php echo esc_attr__('Background Circle','nerko') ?>">
    </div>
    <!-- gradient-position-end -->

    <?php do_action( 'nerko_before_main_content' ); ?>