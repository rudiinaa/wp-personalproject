<?php
/**
 * The template for displaying a single book
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$book_author = booksaw_get_book_detail( get_the_ID(), 'author-name' );
$book_isbn = booksaw_get_book_detail( get_the_ID(), 'isbn' );
$book_price = booksaw_get_book_detail( get_the_ID(), 'price' );
$book_original_price = booksaw_get_book_detail( get_the_ID(), 'original-price' );
$book_pages = booksaw_get_book_detail( get_the_ID(), 'pages' );
$book_publisher = booksaw_get_book_detail( get_the_ID(), 'publisher' );
$book_year = booksaw_get_book_detail( get_the_ID(), 'year' );
$book_language = booksaw_get_book_detail( get_the_ID(), 'language' );
$book_rating = booksaw_get_book_detail( get_the_ID(), 'rating' );
?>

<div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; margin: 2rem 0;">
        <div>
            <?php
            if ( has_post_thumbnail() ) {
                echo '<div style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">';
                the_post_thumbnail( 'book-featured' );
                echo '</div>';
            }
            ?>
        </div>

        <div>
            <div style="margin-bottom: 1rem;">
                <?php
                $categories = get_the_terms( get_the_ID(), 'book_category' );
                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $category ) {
                        echo '<span style="display: inline-block; background-color: #8B7355; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; margin-right: 0.5rem; font-size: 0.85rem; font-weight: 600;">' . esc_html( $category->name ) . '</span>';
                    }
                }
                ?>
            </div>

            <h1><?php the_title(); ?></h1>

            <?php if ( $book_author ) : ?>
                <p style="font-size: 1.1rem; color: #666; margin-bottom: 1rem;"><?php esc_html_e( 'by', 'booksawtheme' ); ?> <strong><?php echo esc_html( $book_author ); ?></strong></p>
            <?php endif; ?>

            <?php if ( $book_rating ) : ?>
                <div style="margin-bottom: 1.5rem;">
                    <?php booksaw_display_rating( $book_rating ); ?>
                </div>
            <?php endif; ?>

            <div style="font-size: 1.8rem; margin: 1.5rem 0; color: #8B7355;">
                <?php if ( $book_price ) : ?>
                    <span><strong>$<?php echo esc_html( number_format( $book_price, 2 ) ); ?></strong></span>
                    <?php if ( $book_original_price && $book_original_price > $book_price ) : ?>
                        <span style="color: #999; text-decoration: line-through; font-size: 0.8em; margin-left: 0.5rem;">$<?php echo esc_html( number_format( $book_original_price, 2 ) ); ?></span>
                    <?php endif; ?>
                <?php else : ?>
                    <span><?php esc_html_e( 'Free', 'booksawtheme' ); ?></span>
                <?php endif; ?>
            </div>

            <button class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1rem; margin-bottom: 1rem;" onclick="alert('<?php esc_attr_e( 'Add to cart functionality can be enabled with WooCommerce integration', 'booksawtheme' ); ?>')">
                <?php esc_html_e( 'Add to Cart', 'booksawtheme' ); ?>
            </button>

            <div style="background-color: #F5F3F0; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <h3><?php esc_html_e( 'Book Details', 'booksawtheme' ); ?></h3>
                
                <?php if ( $book_isbn ) : ?>
                    <p style="margin: 0.5rem 0;">
                        <strong><?php esc_html_e( 'ISBN:', 'booksawtheme' ); ?></strong> <?php echo esc_html( $book_isbn ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $book_pages ) : ?>
                    <p style="margin: 0.5rem 0;">
                        <strong><?php esc_html_e( 'Pages:', 'booksawtheme' ); ?></strong> <?php echo esc_html( $book_pages ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $book_publisher ) : ?>
                    <p style="margin: 0.5rem 0;">
                        <strong><?php esc_html_e( 'Publisher:', 'booksawtheme' ); ?></strong> <?php echo esc_html( $book_publisher ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $book_year ) : ?>
                    <p style="margin: 0.5rem 0;">
                        <strong><?php esc_html_e( 'Publication Year:', 'booksawtheme' ); ?></strong> <?php echo esc_html( $book_year ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $book_language ) : ?>
                    <p style="margin: 0.5rem 0;">
                        <strong><?php esc_html_e( 'Language:', 'booksawtheme' ); ?></strong> <?php echo esc_html( $book_language ); ?>
                    </p>
                <?php endif; ?>
            </div>

            <?php
            $authors = get_the_terms( get_the_ID(), 'book_author' );
            if ( ! empty( $authors ) && ! is_wp_error( $authors ) ) : ?>
                <div style="margin-bottom: 1.5rem;">
                    <h4><?php esc_html_e( 'More Books by This Author', 'booksawtheme' ); ?></h4>
                    <ul style="list-style: none;">
                        <?php
                        foreach ( $authors as $author ) {
                            $author_books = new WP_Query( array(
                                'post_type' => 'book',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'book_author',
                                        'field' => 'id',
                                        'terms' => $author->term_id,
                                    ),
                                ),
                                'posts_per_page' => 3,
                                'post__not_in' => array( get_the_ID() ),
                            ) );

                            if ( $author_books->have_posts() ) {
                                while ( $author_books->have_posts() ) {
                                    $author_books->the_post();
                                    echo '<li style="margin-bottom: 0.5rem;"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
                                }
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div style="margin: 3rem 0;">
        <h2><?php esc_html_e( 'Book Description', 'booksawtheme' ); ?></h2>
        <div style="line-height: 1.8; color: #666;">
            <?php the_content(); ?>
        </div>
    </div>

    <!-- Related Books -->
    <?php
    $related_books = new WP_Query( array(
        'post_type' => 'book',
        'posts_per_page' => 4,
        'post__not_in' => array( get_the_ID() ),
        'tax_query' => array(
            array(
                'taxonomy' => 'book_category',
                'field' => 'id',
                'terms' => wp_get_post_terms( get_the_ID(), 'book_category', array( 'fields' => 'ids' ) ),
            ),
        ),
    ) );

    if ( $related_books->have_posts() ) : ?>
        <section class="section">
            <div class="section-title">
                <h2><?php esc_html_e( 'You Might Also Like', 'booksawtheme' ); ?></h2>
            </div>

            <div class="books-grid">
                <?php
                while ( $related_books->have_posts() ) {
                    $related_books->the_post();
                    get_template_part( 'template-parts/content-book' );
                }
                ?>
            </div>
        </section>
    <?php
    endif;
    wp_reset_postdata();
    ?>
</div>

<?php
get_footer();
