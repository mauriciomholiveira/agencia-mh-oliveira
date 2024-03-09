<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nerko
 */

    $nerko_show_blog_share = get_theme_mod('nerko_show_blog_share', false);
    $nerko_post_tags_width = $nerko_show_blog_share ? 'col-xl-6 col-md-7' : 'col-12';

?>
<?php if ( is_single() ) : ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'blog-post-item format-image' );?>>

        <?php if ( has_post_thumbnail() ): ?>
        <div class="blog-post-thumb">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </div>
        <?php endif; ?>

        <div class="blog-post-content blog-details-content">

            <h2 class="title"><?php the_title();?></h2>

            <!-- blog meta -->
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

            <div class="post-text">
                <?php the_content();?>
                <?php
                    wp_link_pages( [
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'nerko' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ] );
                ?>
            </div>

            <?php if (!empty(get_the_tags())) : ?>
            <div class="blog-details-bottom">

                <div class="row">
                    <div class="<?php echo esc_attr($nerko_post_tags_width); ?>">
                        <?php print nerko_get_tag();?>
                    </div>
                    <?php if (!empty($nerko_show_blog_share)) : ?>
                    <div class="col-xl-6 col-md-5">
                        <div class="blog-details-social text-md-end">
                            <h5 class="social-title"><?php echo esc_html__( 'Social Share :', 'nerko' ) ?></h5>
                            <?php nerko_social_share(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
            <?php endif; ?>

        </div>
    </article>

<?php else: ?>


    <article id="post-<?php the_ID();?>" <?php post_class( 'blog-post-item format-image' );?> >

        <?php if ( has_post_thumbnail() ): ?>
        <div class="blog-post-thumb">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>
        </div>
        <?php endif; ?>

        <div class="blog-post-content">

            <!-- blog meta -->
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

            <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <div class="post-text">
                <?php the_excerpt(); ?>
            </div>

        </div>

    </article>

<?php endif;?>