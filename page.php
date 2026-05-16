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

<div class="container">
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
        <main id="main" class="site-main">
            <?php
            while ( have_posts() ) {
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'page' ); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
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
