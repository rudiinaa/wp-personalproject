<?php get_header(); ?>

<main class="main-content">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> >
                <header>
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta">
                        <span><?php echo esc_html( get_the_date() ); ?></span>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <span> | <a href="<?php the_permalink(); ?>">View image</a></span>
                        <?php endif; ?>
                    </div>
                </header>
                <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; ?>

        <nav class="pagination">
            <?php
            the_posts_pagination( array(
                'mid_size' => 1,
                'prev_text' => __( 'Previous', 'wp-personalproject' ),
                'next_text' => __( 'Next', 'wp-personalproject' ),
            ) );
            ?>
        </nav>

    <?php else : ?>
        <div class="no-posts">
            <p><?php esc_html_e( 'No journal entries found yet. Start writing your first learning note!', 'wp-personalproject' ); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>