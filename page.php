<?php
/**
 * The template for displaying pages
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="page-hero">
    <div class="container">
        <div class="page-hero-inner">
            <span class="page-subtitle"><?php esc_html_e( 'Information', 'booksawtheme' ); ?></span>
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <p class="page-intro"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="page-layout">
        <main id="main" class="site-main">
            <?php
            while ( have_posts() ) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content-card' ); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title visually-hidden"><?php the_title(); ?></h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        the_content();
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'booksawtheme' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php

                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            }
            ?>
        </main><!-- #main -->

        <aside id="secondary" class="widget-area">
            <?php
            if ( is_active_sidebar( 'primary-sidebar' ) ) {
                dynamic_sidebar( 'primary-sidebar' );
            }
            ?>
        </aside><!-- #secondary -->
    </div>
</div>

<?php
get_footer();
