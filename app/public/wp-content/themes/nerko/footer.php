<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nerko
 */
?>


    </main>
    <!-- main-area-end -->


    <?php $nerko_dark_check = get_theme_mod( 'nerko_default_dark', false ); ?>

    <script>
        jQuery(document).ready(function($){

            /*=============================================
                =    		DarkMode Active  	      =
            =============================================*/
            function tg_theme_toggler() {

                $('.modeSwitch').on("change", function () {
                    toggleTheme();
                });

                // set toggle theme scheme
                function tg_set_scheme(tg_theme) {
                    localStorage.setItem('tg_theme_scheme', tg_theme);
                    document.documentElement.setAttribute("tg-theme", tg_theme);
                }

                // toggle theme scheme
                function toggleTheme() {
                    if (localStorage.getItem('tg_theme_scheme') === 'dark') {
                        tg_set_scheme('<?php echo $nerko_dark_check ? 'dark' : 'light' ?>');
                    } else {
                        tg_set_scheme('dark');
                    }
                }

                // set the first theme scheme
                function tg_init_theme() {
                    if (localStorage.getItem('tg_theme_scheme') === 'dark') {
                        tg_set_scheme('dark');
                        document.querySelector('.modeSwitch').checked = true;
                    } else {
                        tg_set_scheme('<?php echo $nerko_dark_check ? 'dark' : 'light' ?>');
                        document.querySelector('.modeSwitch').checked = false;
                    }
                }
                tg_init_theme();
            }
            if ($(".modeSwitch").length > 0) {
                tg_theme_toggler();
            }

        });
    </script>

    <?php
        do_action( 'nerko_footer_style' );

        wp_footer();?>
    </body>
</html>
