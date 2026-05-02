<?php get_header(); ?>

<main class="main-content">
    <section class="entry">
        <header>
            <h1 class="entry-title"><?php esc_html_e( 'Page Not Found', 'wp-personalproject' ); ?></h1>
        </header>
        <div class="entry-content">
            <p><?php esc_html_e( 'Sorry, the page you are looking for does not exist. Try searching or return to the homepage.', 'wp-personalproject' ); ?></p>
            <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return home', 'wp-personalproject' ); ?></a></p>
        </div>
    </section>
</main>

<?php get_footer(); ?>