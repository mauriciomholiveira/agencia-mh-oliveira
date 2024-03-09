<?php

	/**
	* Template part for displaying header layout one
	*
	* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	*
	* @package nerko
	*/

    // Header Settings
    $nerko_show_sticky_header = get_theme_mod( 'nerko_show_sticky_header', false );
    $sticky_header = $nerko_show_sticky_header ? 'sticky-header' : 'sticky-none';

    $nerko_show_mobile_social = get_theme_mod( 'nerko_show_mobile_social', false );

?>


<!-- header-area -->
<header class="header-style-two">
    <div id="<?php echo esc_attr($sticky_header); ?>" class="tg-header__area transparent-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-nav-toggler"><i class="flaticon-menu-1"></i></div>
                    <div class="tgmenu__wrap">
                        <nav class="tgmenu__nav">
                            <div class="logo">
                                <?php nerko_header_logo(); ?>
                            </div>
                            <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-lg-flex">
                                <?php nerko_header_menu(); ?>
                            </div>
                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="tgmobile__menu">
                        <nav class="tgmobile__menu-box">
                            <div class="close-btn"><i class="flaticon-close-1"></i></div>
                            <div class="nav-logo">
                                <?php nerko_mobile_logo(); ?>
                            </div>
                            <div class="tgmobile__menu-outer">
                                <?php nerko_mobile_menu(); ?>
                            </div>

                            <?php if (!empty( $nerko_show_mobile_social )) : ?>
                            <div class="social-links">
                                <?php nerko_mobile_social_profiles(); ?>
                            </div>
                            <?php endif; ?>

                        </nav>
                    </div>
                    <div class="tgmobile__menu-backdrop"></div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area-end -->
