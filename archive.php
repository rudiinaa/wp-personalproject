<?php get_header(); ?>

<main class="main-content">
    <header class="archive-header entry">
        <h1 class="entry-title"><?php the_archive_title(); ?></h1>
        <?php if ( get_the_archive_description() ) : ?>
            <div class="entry-content"><?php the_archive_description(); ?></div>
        <?php endif; ?>
    </header>

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> >
                <header>
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta"><?php echo esc_html( get_the_date() ); ?></div>
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
            <p><?php esc_html_e( 'No entries were found for this archive.', 'wp-personalproject' ); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>