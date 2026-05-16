<?php
/**
 * The template for displaying all single posts
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
                get_template_part( 'template-parts/content' );

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
