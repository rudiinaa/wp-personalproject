<?php
/**
 * Template part for displaying posts
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div style="margin-bottom: 1.5rem; border-radius: 8px; overflow: hidden;">
            <?php the_post_thumbnail( 'book-featured', array( 'style' => 'width: 100%; height: auto; display: block;' ) ); ?>
        </div>
    <?php endif; ?>

    <header class="post-header">
        <div class="post-meta">
            <span><?php esc_html_e( 'Posted on', 'booksawtheme' ); ?> <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
            <span><?php esc_html_e( 'by', 'booksawtheme' ); ?> <?php the_author(); ?></span>
            <span><?php esc_html_e( 'in', 'booksawtheme' ); ?> <?php the_category( ', ' ); ?></span>
        </div>
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="post-title">', '</h1>' );
        else :
            the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        ?>
    </header><!-- .post-header -->

    <div class="post-content">
        <?php
        if ( is_singular() ) {
            the_content( sprintf(
                wp_kses_post( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'booksawtheme' ) ),
                wp_kses_post( get_the_title() )
            ) );
        } else {
            the_excerpt();
        }
        ?>
    </div><!-- .post-content -->

    <?php if ( ! is_singular() ) : ?>
        <footer class="post-footer">
            <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read More →', 'booksawtheme' ); ?></a>
        </footer><!-- .post-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
