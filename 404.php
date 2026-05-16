<?php
/**
 * The template for displaying 404 errors
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
    <div style="text-align: center; padding: 4rem 0;">
        <h1 style="font-size: 3rem; color: #8B7355; margin-bottom: 1rem;">404</h1>
        <h2><?php esc_html_e( 'Page Not Found', 'booksawtheme' ); ?></h2>
        <p style="margin: 1.5rem 0; font-size: 1.1rem;"><?php esc_html_e( 'Sorry, the page you are looking for does not exist. It might have been moved or deleted.', 'booksawtheme' ); ?></p>
        
        <div style="margin: 2rem 0;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Go Home', 'booksawtheme' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/books' ) ); ?>" class="btn btn-secondary" style="margin-left: 1rem;"><?php esc_html_e( 'Browse Books', 'booksawtheme' ); ?></a>
        </div>

        <div style="margin-top: 3rem; background-color: #F5F3F0; padding: 2rem; border-radius: 8px;">
            <h3><?php esc_html_e( 'Try searching for something', 'booksawtheme' ); ?></h3>
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin-top: 1rem;">
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="s" placeholder="<?php esc_attr_e( 'Search...', 'booksawtheme' ); ?>" style="flex: 1; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <input type="hidden" name="post_type" value="book">
                    <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Search', 'booksawtheme' ); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
get_footer();
