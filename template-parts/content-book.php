<?php
/**
 * Template part for displaying books
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$book_price = booksaw_get_book_detail( get_the_ID(), 'price' );
$book_original_price = booksaw_get_book_detail( get_the_ID(), 'original-price' );
$book_rating = booksaw_get_book_detail( get_the_ID(), 'rating' );
$book_author = booksaw_get_book_detail( get_the_ID(), 'author-name' );
$discount_percent = '';

if ( $book_original_price && $book_price && $book_original_price > $book_price ) {
    $discount_percent = round( ( ( $book_original_price - $book_price ) / $book_original_price ) * 100 );
}
?>

<div class="book-card">
    <div style="position: relative;">
        <?php
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'book-cover', array( 'class' => 'book-image' ) );
        } else {
            echo '<div class="book-image" style="background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999;">' . esc_html__( 'No Image', 'booksawtheme' ) . '</div>';
        }
        ?>
        <?php if ( $discount_percent ) : ?>
            <div style="position: absolute; top: 10px; right: 10px; background-color: #D4A574; color: white; padding: 5px 10px; border-radius: 4px; font-weight: bold; font-size: 0.85rem;">
                -<?php echo esc_html( $discount_percent ); ?>%
            </div>
        <?php endif; ?>
    </div>

    <div class="book-content">
        <div class="book-category">
            <?php
            $categories = get_the_terms( get_the_ID(), 'book_category' );
            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                echo esc_html( $categories[0]->name );
            } else {
                esc_html_e( 'Uncategorized', 'booksawtheme' );
            }
            ?>
        </div>

        <h3 class="book-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ( $book_author ) : ?>
            <p class="book-author"><?php echo esc_html( $book_author ); ?></p>
        <?php endif; ?>

        <p class="book-description">
            <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
        </p>

        <div class="book-meta">
            <div>
                <?php if ( $book_price ) : ?>
                    <span class="book-price">
                        $<?php echo esc_html( number_format( $book_price, 2 ) ); ?>
                    </span>
                    <?php if ( $book_original_price && $book_original_price > $book_price ) : ?>
                        <span style="color: #999; text-decoration: line-through; font-size: 0.9rem; margin-left: 0.5rem;">
                            $<?php echo esc_html( number_format( $book_original_price, 2 ) ); ?>
                        </span>
                    <?php endif; ?>
                <?php else : ?>
                    <span class="book-price"><?php esc_html_e( 'Free', 'booksawtheme' ); ?></span>
                <?php endif; ?>
            </div>
            
            <?php if ( $book_rating ) : ?>
                <?php booksaw_display_rating( $book_rating ); ?>
            <?php endif; ?>
        </div>

        <div class="book-footer">
            <button class="btn-add-cart" onclick="alert('<?php esc_attr_e( 'Add to cart functionality can be enabled with WooCommerce integration', 'booksawtheme' ); ?>')">
                <?php esc_html_e( 'Add to Cart', 'booksawtheme' ); ?>
            </button>
        </div>
    </div>
</div>
