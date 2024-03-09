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

    // Header Right
    $nerko_show_header_right = get_theme_mod( 'nerko_show_header_right', false );
    $nerko_show_header_social = get_theme_mod( 'nerko_show_header_social', false );
    $nerko_header_twitter_url = get_theme_mod('nerko_header_twitter_url', __('#','nerko'));
    $nerko_header_discord_url = get_theme_mod('nerko_header_discord_url', __('#','nerko'));
    $nerko_header_instagram_url = get_theme_mod('nerko_header_instagram_url', __('#','nerko'));
    $nerko_show_heder_btn = get_theme_mod( 'nerko_show_heder_btn', false );
    $nerko_show_mobile_social = get_theme_mod( 'nerko_show_mobile_social', false );

    // Popup Modal
    $nerko_modal_title = get_theme_mod( 'nerko_modal_title', __( 'Connect Wallet', 'nerko' ) );
    $nerko_modal_paragraph = get_theme_mod( 'nerko_modal_paragraph', __( 'Please select a wallet to connect for start Minting your NFTs', 'nerko' ) );
    $nerko_modal_privacy = get_theme_mod( 'nerko_modal_privacy', __( 'By connecting your wallet, you agree to our Terms of Service and our Privacy Policy', 'nerko' ) );

    $nerko_show_popup_modal = get_theme_mod( 'nerko_show_popup_modal', false );
    $nerko_show_metamask = get_theme_mod( 'nerko_show_metamask', true );
    $nerko_show_bitgo = get_theme_mod( 'nerko_show_bitgo', false );
    $nerko_show_trustWallet = get_theme_mod( 'nerko_show_trustWallet', false );
    $nerko_show_coinbase = get_theme_mod( 'nerko_show_coinbase', false );

    $nerko_metamask_url = get_theme_mod('nerko_metamask_url', __( '#', 'nerko' ));
    $nerko_bitgo_url = get_theme_mod('nerko_bitgo_url', __( '#', 'nerko' ));
    $nerko_trustWallet_url = get_theme_mod('nerko_trustWallet_url', __( '#', 'nerko' ));
    $nerko_coinbase_url = get_theme_mod('nerko_coinbase_url', __( '#', 'nerko' ));

?>


<!-- header-area -->
<header class="header-style-three header-style-four">
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
                            <div class="tgmenu__action">
                                <ul class="list-wrap">
                                    <li class="header-social">

                                        <?php if ( !empty($nerko_header_twitter_url) ) : ?>
                                        <a href="<?php echo esc_url( $nerko_header_twitter_url ); ?>" class="d-none d-sm-block"><i class="fab fa-twitter"></i></a>
                                        <?php endif; ?>

                                        <?php if ( !empty($nerko_header_discord_url) ) : ?>
                                        <a href="<?php echo esc_url( $nerko_header_discord_url ); ?>"><i class="fab fa-discord"></i></a>
                                        <?php endif; ?>

                                        <?php if ( !empty($nerko_header_instagram_url) ) : ?>
                                        <a href="<?php echo esc_url( $nerko_header_instagram_url ); ?>"><i class="fab fa-instagram"></i></a>
                                        <?php endif; ?>

                                        <?php if ( !empty($nerko_show_heder_btn) ) : ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#connectModal"><i class="fas fa-wallet"></i></a>
                                        <?php endif; ?>

                                    </li>
                                </ul>
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

    <?php if ( !empty($nerko_show_popup_modal) ) : ?>
    <!-- Connect Wallet Modal -->
    <div class="connect__modal">
        <div class="modal fade" id="connectModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal__wrapper">
                        <div class="modal__header">
                            <?php if(!empty( $nerko_modal_title )) : ?>
                                <h2 class="title"><?php echo esc_html( $nerko_modal_title ); ?></h2>
                            <?php endif; ?>
                            <button data-bs-dismiss="modal" aria-label="Close">
                                <i class="flaticon-close-1"></i>
                            </button>
                        </div>
                        <div class="modal__body text-center">
                            <?php if(!empty( $nerko_modal_paragraph )) : ?>
                                <p><?php echo esc_html( $nerko_modal_paragraph ); ?></p>
                            <?php endif; ?>
                            <div class="connect__section">
                                <ul class="list-wrap">

                                    <?php if(!empty( $nerko_show_metamask )) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( $nerko_metamask_url ); ?>" class="connect-meta"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/metamask.svg" alt="<?php echo esc_attr__( 'MetaMask', 'nerko' ) ?>"><?php echo esc_html__( 'MetaMask', 'nerko' ); ?></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(!empty( $nerko_show_bitgo )) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( $nerko_bitgo_url ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/bitgo.svg" alt="<?php echo esc_attr__( 'BitGo', 'nerko' ) ?>"><?php echo esc_html__( 'BitGo', 'nerko' ); ?></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(!empty( $nerko_show_trustWallet )) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( $nerko_trustWallet_url ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/trust.svg" alt="<?php echo esc_attr__( 'Trust', 'nerko' ) ?>"><?php echo esc_html__( 'Trust Wallet', 'nerko' ); ?></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(!empty( $nerko_show_coinbase )) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( $nerko_coinbase_url ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/coinbase.svg" alt="<?php echo esc_attr__( 'Coinbase', 'nerko' ) ?>"><?php echo esc_html__( 'Coinbase', 'nerko' ); ?></a>
                                    </li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                            <?php if(!empty( $nerko_modal_privacy )) : ?>
                                <p class="privacy-text"><?php echo esc_html( $nerko_modal_privacy ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Connect Wallet Modal -->
    <?php endif; ?>

</header>
<!-- header-area-end -->