<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nerko
 */

$nerko_blog_btn = get_theme_mod('nerko_blog_btn', __( 'Read More', 'nerko' ) );
$nerko_blog_btn_switch = get_theme_mod( 'nerko_blog_btn_switch', true );

?>

<?php if ( !empty( $nerko_blog_btn_switch ) ): ?>
<div class="tg-blog-post-bottom">
    <a href="<?php the_permalink(); ?>" class="btn gradient-btn"><?php print esc_html($nerko_blog_btn); ?> <i class="fas fa-arrow-right"></i></a>
</div>
<?php endif;?>