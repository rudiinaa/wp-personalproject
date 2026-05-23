<?php
/**
 * Helper Functions
 * 
 * Additional utility functions for the BookSaw theme
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get book price with discount calculation
 *
 * @since 1.0.0
 * @param int $post_id Post ID
 * @return array Price information
 */
function booksaw_get_price_info( $post_id ) {
    $price = floatval( get_post_meta( $post_id, '_book_price', true ) );
    $original_price = floatval( get_post_meta( $post_id, '_book_original_price', true ) );
    
    $discount = 0;
    $discount_percent = 0;
    
    if ( $original_price && $original_price > $price ) {
        $discount = $original_price - $price;
        $discount_percent = round( ( $discount / $original_price ) * 100 );
    }
    
    return array(
        'current' => $price,
        'original' => $original_price,
        'discount' => $discount,
        'discount_percent' => $discount_percent,
        'is_discounted' => $discount_percent > 0,
    );
}

/**
 * Get a book short description.
 *
 * Uses the saved short description if available, otherwise returns a default text for known sample books.
 *
 * @since 1.0.0
 * @param int $post_id Post ID
 * @return string
 */
function booksaw_get_book_short_description( $post_id ) {
    $description = get_post_meta( $post_id, '_book_short_description', true );
    if ( $description ) {
        return $description;
    }

    $title = strtolower( trim( get_the_title( $post_id ) ) );
    $title = preg_replace( '/[^a-z0-9]+/', ' ', $title );
    $title = trim( $title );

    $defaults = array(
        'atomic habits' => 'A practical guide to building better routines through tiny habit changes that compound over time.',
        'october sky' => 'The inspiring true story of a young man who pursued rocket science against all odds in a small mining town.',
        'the king s speech' => 'A moving historical drama about a leader overcoming his stammer with courage and support.',
        'a beautiful mind' => 'A powerful portrait of genius and resilience, following a mathematician who battles personal challenges while changing the world.',
        'taxi driver' => 'A gritty portrait of a lonely New York cab driver whose nights behind the wheel spiral into obsession and a desperate search for meaning.',
        'crime and punishment' => 'A psychological masterpiece that follows a troubled young man as he wrestles with guilt, morality, and the consequences of a dark act.',
        'gangsta granny' => 'A fun, heartwarming caper about a boy and his secret-agent grandmother who plot a daring museum heist together.',
        'rich dad poor dad' => 'A bestselling personal finance guide that contrasts two mindsets and reveals the principles of wealth-building through investing and entrepreneurship.',
        'the story of art' => 'A sweeping visual history of art that traces the great movements, masterpieces, and ideas from antiquity to the modern age.',
        'shutter island' => 'A tense psychological thriller about a U.S. Marshal investigating a mysterious disappearance on a remote, storm-battered island asylum.',
    );

    if ( isset( $defaults[ $title ] ) ) {
        return $defaults[ $title ];
    }

    $author = get_post_meta( $post_id, '_book_author_name', true );
    $categories = get_the_terms( $post_id, 'book_category' );
    $category_name = '';

    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
        $category_name = $categories[0]->name;
    }

    if ( $category_name && $author ) {
        return sprintf(
            '%s is a %s book by %s that brings its story to life through vivid detail, memorable characters, and clear insight.',
            $title,
            strtolower( $category_name ),
            $author
        );
    }

    if ( $category_name ) {
        return sprintf(
            '%s is a compelling %s title that combines smart storytelling with unforgettable characters and a strong emotional arc.',
            $title,
            strtolower( $category_name )
        );
    }

    if ( $author ) {
        return sprintf(
            '%s is a compelling read by %s that explores its themes with clarity, heart, and memorable storytelling.',
            $title,
            $author
        );
    }

    return sprintf(
        '%s is an engaging new book that delivers fresh ideas, vivid characters, and an immersive reading experience.',
        $title
    );
}

/**
 * Format price for display
 *
 * @since 1.0.0
 * @param float $price Price value
 * @param string $symbol Currency symbol
 * @return string Formatted price
 */
function booksaw_format_price( $price, $symbol = '$' ) {
    return $symbol . number_format( $price, 2 );
}

/**
 * Get books by author
 *
 * @since 1.0.0
 * @param int|object $author Author term ID or object
 * @param int $limit Number of books to retrieve
 * @return WP_Query Book query object
 */
function booksaw_get_author_books( $author, $limit = 10 ) {
    $author_id = is_object( $author ) ? $author->term_id : $author;
    
    return new WP_Query( array(
        'post_type' => 'book',
        'posts_per_page' => $limit,
        'tax_query' => array(
            array(
                'taxonomy' => 'book_author',
                'field' => 'id',
                'terms' => $author_id,
            ),
        ),
    ) );
}

/**
 * Get books by category
 *
 * @since 1.0.0
 * @param int|object $category Category term ID or object
 * @param int $limit Number of books to retrieve
 * @return WP_Query Book query object
 */
function booksaw_get_category_books( $category, $limit = 10 ) {
    $cat_id = is_object( $category ) ? $category->term_id : $category;
    
    return new WP_Query( array(
        'post_type' => 'book',
        'posts_per_page' => $limit,
        'tax_query' => array(
            array(
                'taxonomy' => 'book_category',
                'field' => 'id',
                'terms' => $cat_id,
            ),
        ),
    ) );
}

/**
 * Get random books
 *
 * @since 1.0.0
 * @param int $limit Number of books to retrieve
 * @return WP_Query Book query object
 */
function booksaw_get_random_books( $limit = 4 ) {
    return new WP_Query( array(
        'post_type' => 'book',
        'posts_per_page' => $limit,
        'orderby' => 'rand',
    ) );
}

/**
 * Get bestselling books (by rating)
 *
 * @since 1.0.0
 * @param int $limit Number of books to retrieve
 * @return WP_Query Book query object
 */
function booksaw_get_bestsellers( $limit = 4 ) {
    return new WP_Query( array(
        'post_type' => 'book',
        'posts_per_page' => $limit,
        'meta_key' => '_book_rating',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ) );
}

/**
 * Check if a book is on sale
 *
 * @since 1.0.0
 * @param int $post_id Post ID
 * @return bool True if book is on sale
 */
function booksaw_is_book_on_sale( $post_id ) {
    $price_info = booksaw_get_price_info( $post_id );
    return $price_info['is_discounted'];
}

/**
 * Check if a book is marked as featured.
 *
 * @since 1.0.0
 * @param int $post_id Post ID
 * @return bool True if book is featured
 */
function booksaw_is_book_featured( $post_id ) {
    return '1' === get_post_meta( $post_id, '_featured_book', true );
}

/**
 * Get highest rated books
 *
 * @since 1.0.0
 * @param int $limit Number of books
 * @return WP_Query Book query object
 */
function booksaw_get_rated_books( $limit = 4 ) {
    return new WP_Query( array(
        'post_type' => 'book',
        'posts_per_page' => $limit,
        'meta_key' => '_book_rating',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ) );
}

/**
 * Display book category badge
 *
 * @since 1.0.0
 * @param int $post_id Post ID
 * @param string $style Optional CSS style
 */
function booksaw_display_category_badge( $post_id, $style = '' ) {
    $categories = get_the_terms( $post_id, 'book_category' );
    
    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
        $category = $categories[0];
        $css = $style ? ' style="' . esc_attr( $style ) . '"' . '' : '';
        echo '<span class="book-category"' . wp_kses_post( $css ) . '>' . esc_html( $category->name ) . '</span>';
    }
}

/**
 * Get book excerpt with custom length
 *
 * @since 1.0.0
 * @param int $post_id Post ID
 * @param int $length Word count
 * @return string Excerpt
 */
function booksaw_get_book_excerpt( $post_id, $length = 20 ) {
    $post = get_post( $post_id );
    
    if ( ! $post ) {
        return '';
    }
    
    $excerpt = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
    return wp_trim_words( wp_strip_all_tags( $excerpt ), $length, '...' );
}

/**
 * Get related books
 *
 * @since 1.0.0
 * @param int $post_id Post ID
 * @param int $number Number of related books
 * @return WP_Query Book query object
 */
function booksaw_get_related_books( $post_id, $number = 4 ) {
    $categories = wp_get_post_terms( $post_id, 'book_category', array( 'fields' => 'ids' ) );
    
    if ( empty( $categories ) ) {
        return booksaw_get_random_books( $number );
    }
    
    return new WP_Query( array(
        'post_type' => 'book',
        'posts_per_page' => $number,
        'post__not_in' => array( $post_id ),
        'tax_query' => array(
            array(
                'taxonomy' => 'book_category',
                'field' => 'id',
                'terms' => $categories,
            ),
        ),
    ) );
}
