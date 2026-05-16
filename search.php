<?php
/**
 * The template for displaying search results
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
    <div style="margin: 2rem 0;">
        <h1>
            <?php
            printf(
                esc_html__( 'Search Results for: %s', 'booksawtheme' ),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
        <p><?php echo esc_html( $wp_query->found_posts ); ?> <?php esc_html_e( 'results found', 'booksawtheme' ); ?></p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
        <main id="main" class="site-main">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    
                    if ( get_post_type() === 'book' ) {
                        get_template_part( 'template-parts/content-book' );
                    } else {
                        get_template_part( 'template-parts/content' );
                    }
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
