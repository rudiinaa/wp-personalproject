<?php
/**
 * The template for displaying book archives
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
        <h1><?php
            if ( is_tax( 'book_category' ) ) {
                $term = get_queried_object();
                esc_html_e( 'Books in: ', 'booksawtheme' );
                echo esc_html( $term->name );
            } elseif ( is_tax( 'book_author' ) ) {
                $term = get_queried_object();
                esc_html_e( 'Books by: ', 'booksawtheme' );
                echo esc_html( $term->name );
            } else {
                esc_html_e( 'Books', 'booksawtheme' );
            }
        ?></h1>
        <p><?php esc_html_e( 'Explore our complete collection of books', 'booksawtheme' ); ?></p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
        <main id="main" class="site-main">
            <div class="books-grid">
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'template-parts/content-book' );
                    }
                } else {
                    get_template_part( 'template-parts/content-none' );
                }
                ?>
            </div>

            <?php the_posts_pagination(); ?>
        </main><!-- #main -->

        <aside id="secondary" class="widget-area">
            <div class="widget">
                <h3 class="widget-title"><?php esc_html_e( 'Filter by Category', 'booksawtheme' ); ?></h3>
                <ul>
                    <?php
                    $categories = get_terms( array(
                        'taxonomy'   => 'book_category',
                        'hide_empty' => true,
                    ) );

                    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                        foreach ( $categories as $category ) {
                            echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . ' (' . esc_html( $category->count ) . ')</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="widget">
                <h3 class="widget-title"><?php esc_html_e( 'Popular Authors', 'booksawtheme' ); ?></h3>
                <ul>
                    <?php
                    $authors = get_terms( array(
                        'taxonomy'   => 'book_author',
                        'hide_empty' => true,
                        'number'     => 10,
                    ) );

                    if ( ! empty( $authors ) && ! is_wp_error( $authors ) ) {
                        foreach ( $authors as $author ) {
                            echo '<li><a href="' . esc_url( get_term_link( $author ) ) . '">' . esc_html( $author->name ) . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

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
