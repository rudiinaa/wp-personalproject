<?php
/**
 * The footer for BookSaw theme
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
        </div><!-- #content -->

        <footer id="colophon" class="site-footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-widget">
                        <h3><?php esc_html_e( 'About Our Store', 'booksawtheme' ); ?></h3>
                        <p><?php esc_html_e( 'Welcome to BookSaw, your premier destination for quality books. We curate an extensive collection of titles across all genres.', 'booksawtheme' ); ?></p>
                    </div>

                    <div class="footer-widget">
                        <h3><?php esc_html_e( 'Quick Links', 'booksawtheme' ); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>"><?php esc_html_e( 'Shop', 'booksawtheme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About Us', 'booksawtheme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'booksawtheme' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/articles' ) ); ?>"><?php esc_html_e( 'Articles', 'booksawtheme' ); ?></a></li>
                        </ul>
                    </div>

                    <div class="footer-widget">
                        <h3><?php esc_html_e( 'Categories', 'booksawtheme' ); ?></h3>
                        <ul>
                            <?php
                            $categories = get_terms( array(
                                'taxonomy' => 'book_category',
                                'hide_empty' => true,
                                'number' => 5,
                            ) );
                            
                            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                foreach ( $categories as $category ) {
                                    echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="footer-widget">
                        <h3><?php esc_html_e( 'Contact Info', 'booksawtheme' ); ?></h3>
                        <ul>
                            <li><?php esc_html_e( 'Email: info@booksaw.com', 'booksawtheme' ); ?></li>
                            <li><?php esc_html_e( 'Phone: +1 (555) 123-4567', 'booksawtheme' ); ?></li>
                            <li><?php esc_html_e( 'Address: 123 Book Street, Reading City', 'booksawtheme' ); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="footer-bottom">
                    <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>. <?php esc_html_e( 'All Rights Reserved.', 'booksawtheme' ); ?></p>
                </div>
            </div>
        </footer><!-- #colophon -->
    </div><!-- #page -->

    <?php wp_footer(); ?>
</body>
</html>
