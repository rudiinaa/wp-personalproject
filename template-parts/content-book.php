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
$book_google_rating = booksaw_get_book_detail( get_the_ID(), 'google-review-rating' );
$book_author = booksaw_get_book_detail( get_the_ID(), 'author-name' );
$book_review_count = booksaw_get_book_detail( get_the_ID(), 'review-count' );
$book_google_review_count = booksaw_get_book_detail( get_the_ID(), 'google-review-count' );
$book_review_excerpt = booksaw_get_book_detail( get_the_ID(), 'review-excerpt' );
$book_google_review_excerpt = booksaw_get_book_detail( get_the_ID(), 'google-review-excerpt' );
$book_product_id = get_post_meta( get_the_ID(), '_book_product_id', true );
$add_to_cart_base = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/' );
$discount_percent = '';

if ( $book_original_price && $book_price && $book_original_price > $book_price ) {
    $discount_percent = round( ( ( $book_original_price - $book_price ) / $book_original_price ) * 100 );
}
?>

<div class="book-card">
    <div class="book-badges">
        <?php if ( booksaw_is_book_featured( get_the_ID() ) ) : ?>
            <span class="book-badge book-badge-featured"><?php esc_html_e( 'Featured', 'booksawtheme' ); ?></span>
        <?php endif; ?>
        <?php if ( booksaw_is_book_on_sale( get_the_ID() ) ) : ?>
            <span class="book-badge book-badge-sale"><?php esc_html_e( 'Offer', 'booksawtheme' ); ?></span>
        <?php endif; ?>
    </div>

    <div style="position: relative;">
        <?php
        if ( has_post_thumbnail() ) {
            $thumbnail_id = get_post_thumbnail_id();
            $upload_dir = wp_get_upload_dir();
            $image_src = wp_get_attachment_image_src( $thumbnail_id, 'book-cover' );

            if ( $image_src ) {
                $file_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $image_src[0] );
                if ( ! file_exists( $file_path ) ) {
                    $image_src = false;
                }
            }

            if ( ! $image_src ) {
                $image_src = wp_get_attachment_image_src( $thumbnail_id, 'full' );
            }

            if ( $image_src ) {
                $alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                if ( ! $alt_text ) {
                    $alt_text = get_the_title( $thumbnail_id );
                }
                echo '<a href="' . esc_url( get_permalink() ) . '">';
                echo '<img src="' . esc_url( $image_src[0] ) . '" width="' . esc_attr( $image_src[1] ) . '" height="' . esc_attr( $image_src[2] ) . '" class="book-image" alt="' . esc_attr( $alt_text ) . '" />';
                echo '</a>';
            } else {
                echo '<a href="' . esc_url( get_permalink() ) . '">';
                echo '<div class="book-image" style="background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999;">' . esc_html__( 'No Image', 'booksawtheme' ) . '</div>';
                echo '</a>';
            }
        } else {
            echo '<a href="' . esc_url( get_permalink() ) . '">';
            echo '<div class="book-image" style="background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999;">' . esc_html__( 'No Image', 'booksawtheme' ) . '</div>';
            echo '</a>';
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

        <?php
        $book_short_description = booksaw_get_book_short_description( get_the_ID() );
        if ( $book_short_description ) : ?>
            <p class="book-description"><?php echo esc_html( wp_trim_words( $book_short_description, 18, '...' ) ); ?></p>
        <?php else : ?>
            <p class="book-description"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?></p>
        <?php endif; ?>

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

                <?php $google_count = absint( $book_google_review_count ); ?>
                <div class="book-review-count" style="font-size: 0.85rem; color: #666; margin-top: 0.4rem;">
                    <?php if ( $google_count ) : ?>
                        <?php echo esc_html( sprintf( _n( '%s Google review', '%s Google reviews', $google_count, 'booksawtheme' ), number_format_i18n( $google_count ) ) ); ?>
                    <?php else : ?>
                        <?php echo esc_html( $book_review_count ? sprintf( _n( '%s review', '%s reviews', absint( $book_review_count ), 'booksawtheme' ), number_format_i18n( absint( $book_review_count ) ) ) : esc_html__( 'No reviews yet', 'booksawtheme' ) ); ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ( $book_google_rating || $book_rating ) : ?>
                <?php booksaw_display_rating( $book_google_rating ? $book_google_rating : $book_rating ); ?>
            <?php endif; ?>
        </div>
        <div class="book-review-summary" style="font-size: 0.9rem; color: #555; margin-bottom: 1rem;">
            <?php if ( $book_google_review_excerpt ) : ?>
                &ldquo;<?php echo esc_html( $book_google_review_excerpt ); ?>&rdquo;
                <span style="display:block; font-size:0.8rem; color:#999; margin-top:0.3rem;"><?php esc_html_e( 'Based on Google results', 'booksawtheme' ); ?></span>
            <?php elseif ( $book_review_excerpt ) : ?>
                &ldquo;<?php echo esc_html( $book_review_excerpt ); ?>&rdquo;
            <?php else : ?>
                <?php esc_html_e( 'No review excerpt available yet.', 'booksawtheme' ); ?>
            <?php endif; ?>
        </div>

        <div class="book-footer">
            <?php if ( class_exists( 'WooCommerce' ) && $book_product_id && get_post_type( $book_product_id ) === 'product' ) : ?>
                <a href="<?php echo esc_url( add_query_arg( 'add-to-cart', absint( $book_product_id ), $add_to_cart_base ) ); ?>" class="btn-add-cart">
                    <?php esc_html_e( 'Add to Cart', 'booksawtheme' ); ?>
                </a>
            <?php else : ?>
                <button class="btn-add-cart" style="opacity: 0.5; cursor: not-allowed;" disabled>
                    <?php esc_html_e( 'Add to Cart', 'booksawtheme' ); ?>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
