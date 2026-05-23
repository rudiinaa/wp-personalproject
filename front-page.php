<?php
/**
 * The front page template
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1><?php esc_html_e( 'Welcome to BookSaw', 'booksawtheme' ); ?></h1>
        <p><?php esc_html_e( 'Discover Thousand of Books, Stories, and Knowledge at Your Fingertips', 'booksawtheme' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/books' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Start Shopping', 'booksawtheme' ); ?></a>
    </div>
</section>

<div class="container">
    <!-- Featured Books Section -->
    <section class="section featured-section">
        <div class="section-title">
            <h2><?php esc_html_e( 'Featured Books', 'booksawtheme' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Explore our handpicked selection of bestsellers and new releases', 'booksawtheme' ); ?></p>
        </div>

        <div class="books-grid">
            <?php
            $displayed_book_ids = array();
            $featured_books = new WP_Query( array(
                'post_type'      => 'book',
                'posts_per_page' => -1,
                'meta_key'       => '_featured_book',
                'meta_value'     => '1',
            ) );

            if ( $featured_books->have_posts() ) {
                while ( $featured_books->have_posts() ) {
                    $featured_books->the_post();
                    get_template_part( 'template-parts/content-book' );
                    $displayed_book_ids[] = get_the_ID();
                }
            } else {
                // Show latest books if no featured books
                $latest_books = new WP_Query( array(
                    'post_type'      => 'book',
                    'posts_per_page' => 4,
                ) );

                if ( $latest_books->have_posts() ) {
                    while ( $latest_books->have_posts() ) {
                        $latest_books->the_post();
                        get_template_part( 'template-parts/content-book' );
                        $displayed_book_ids[] = get_the_ID();
                    }
                }
                wp_reset_postdata();
            }
            wp_reset_postdata();
            ?>
        </div>
    </section>

    <!-- Books with Offer Section -->
    <section class="section">
        <div class="section-title">
            <h2><?php esc_html_e( 'Books With Offer', 'booksawtheme' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Check out these amazing deals and exclusive offers on quality books', 'booksawtheme' ); ?></p>
        </div>

        <div class="books-grid">
            <?php
            $offer_books = new WP_Query( array(
                'post_type'      => 'book',
                'posts_per_page' => -1,
                'meta_query'     => array(
                    array(
                        'key'     => '_book_original_price',
                        'compare' => 'EXISTS',
                    ),
                ),
                'post__not_in'   => $displayed_book_ids,
            ) );

            if ( $offer_books->have_posts() ) {
                while ( $offer_books->have_posts() ) {
                    $offer_books->the_post();
                    get_template_part( 'template-parts/content-book' );
                }
            }
            wp_reset_postdata();
            ?>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="section">
        <div class="newsletter-section">
            <h3><?php esc_html_e( 'Subscribe to Our Newsletter', 'booksawtheme' ); ?></h3>
            <p><?php esc_html_e( 'Get the latest updates on new books, exclusive offers, and literary news delivered to your inbox.', 'booksawtheme' ); ?></p>
            <form class="newsletter-form" method="post">
                <input type="email" placeholder="<?php esc_attr_e( 'Enter your email address', 'booksawtheme' ); ?>" required>
                <button type="submit"><?php esc_html_e( 'Subscribe', 'booksawtheme' ); ?></button>
            </form>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="section">
        <div class="section-title">
            <h2><?php esc_html_e( 'Latest Articles', 'booksawtheme' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Read the latest book reviews, author interviews, and literary discussions', 'booksawtheme' ); ?></p>
        </div>

        <div class="books-grid">
            <?php
            $latest_articles = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
            ) );

            if ( $latest_articles->have_posts() ) {
                while ( $latest_articles->have_posts() ) {
                    $latest_articles->the_post();
                    ?>
                    <article class="post-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div style="height: 250px; overflow: hidden; border-radius: 8px; margin-bottom: 1rem;">
                                <?php the_post_thumbnail( 'book-featured', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-meta">
                                <?php echo esc_html( get_the_date() ); ?> <?php esc_html_e( 'by', 'booksawtheme' ); ?> <?php the_author(); ?>
                            </div>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read More →', 'booksawtheme' ); ?></a>
                        </div>
                    </article>
                    <?php
                }
            }
            wp_reset_postdata();
            ?>
        </div>
    </section>
</div>

<?php
get_footer();
