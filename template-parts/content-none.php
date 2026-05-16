<?php
/**
 * Template part for displaying no content
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Nothing here', 'booksawtheme' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if ( is_home() && current_user_can( 'publish_posts' ) ) {
            printf(
                '<p>' . wp_kses_post( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'booksawtheme' ) ) . '</p>',
                esc_url( admin_url( 'post-new.php' ) )
            );
        } elseif ( is_search() ) {
            esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'booksawtheme' );
        } else {
            esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'booksawtheme' );
        }
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
