<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<div class="site-wrapper">
<header class="site-header">
    <div class="main-content">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav class="site-navigation" aria-label="Primary menu">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class' => 'primary-menu',
                    'container' => false,
                ) );
                ?>
            </nav>
        <?php endif; ?>
    </div>
</header>