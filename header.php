<?php
/**
 * The header for BookSaw theme
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <div id="page" class="site">
        <header id="masthead" class="site-header">
            <div class="container">
                <div class="site-header">
                    <div class="site-branding">
                        <?php 
                        if ( has_custom_logo() ) {
                            the_custom_logo();
                        }
                        
                        if ( is_front_page() && is_home() ) : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                        endif;
                        
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description ) : ?>
                            <p class="site-description"><?php echo wp_kses_post( $description ); ?></p>
                        <?php endif; ?>
                    </div>

                    <nav id="site-navigation" class="site-navigation">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-nav',
                            'fallback_cb'    => 'wp_page_menu',
                        ) );
                        ?>
                    </nav>

                    <div class="header-icons">
                        <a href="#" title="<?php esc_attr_e( 'Search', 'booksawtheme' ); ?>" class="header-search-icon">
                            <span class="dashicon">🔍</span>
                        </a>
                        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Shopping Cart', 'booksawtheme' ); ?>" class="header-cart-icon">
                                <span class="dashicon">🛒</span>
                                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( wp_login_url() ); ?>" title="<?php esc_attr_e( 'Account', 'booksawtheme' ); ?>" class="header-account-icon">
                            <span class="dashicon">👤</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div id="content" class="site-content">
