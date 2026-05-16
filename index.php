<?php
/**
 * The main template file
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
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    get_template_part( 'template-parts/content' );
                }
                the_posts_pagination();
            } else {
                get_template_part( 'template-parts/content-none' );
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
