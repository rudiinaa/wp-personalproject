<?php
/**
 * BookSaw Theme Functions and Definitions
 *
 * @package BookSaw
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'BOOKSAW_VERSION', '1.0.0' );
define( 'BOOKSAW_DIR', get_template_directory() );
define( 'BOOKSAW_URI', get_template_directory_uri() );

require_once BOOKSAW_DIR . '/inc/helpers.php';

/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * @since 1.0.0
 */
function booksaw_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 250, 300, true );

    // Register navigation menus.
    register_nav_menus( array(
        'primary'   => esc_html__( 'Primary Menu', 'booksawtheme' ),
        'footer'    => esc_html__( 'Footer Menu', 'booksawtheme' ),
    ) );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add support for custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for wide blocks.
    add_theme_support( 'align-wide' );

    // Add support for block styles.
    add_theme_support( 'wp-block-styles' );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    // Load text domain.
    load_theme_textdomain( 'booksawtheme', BOOKSAW_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'booksaw_setup' );

/**
 * Register widget areas.
 *
 * @since 1.0.0
 */
function booksaw_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'booksawtheme' ),
        'id'            => 'primary-sidebar',
        'description'   => esc_html__( 'Main sidebar', 'booksawtheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area', 'booksawtheme' ),
        'id'            => 'footer-sidebar',
        'description'   => esc_html__( 'Footer widget area', 'booksawtheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'booksaw_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function booksaw_enqueue_assets() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'booksaw-style', BOOKSAW_URI . '/style.css', array(), BOOKSAW_VERSION );

    // Enqueue additional CSS
    wp_enqueue_style( 'booksaw-responsive', BOOKSAW_URI . '/assets/css/responsive.css', array( 'booksaw-style' ), BOOKSAW_VERSION );

    // Enqueue scripts
    wp_enqueue_script( 'booksaw-main', BOOKSAW_URI . '/assets/js/main.js', array(), BOOKSAW_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'booksaw_enqueue_assets' );

/**
 * Register custom post type for Books.
 *
 * @since 1.0.0
 */
function booksaw_register_post_types() {
    /**
     * Register 'book' post type.
     */
    register_post_type( 'book', array(
        'labels'              => array(
            'name'               => esc_html_x( 'Books', 'Post Type General Name', 'booksawtheme' ),
            'singular_name'      => esc_html_x( 'Book', 'Post Type Singular Name', 'booksawtheme' ),
            'menu_name'          => esc_html_x( 'Books', 'Admin Menu text', 'booksawtheme' ),
            'name_admin_bar'     => esc_html_x( 'Book', 'Add New on Toolbar', 'booksawtheme' ),
            'archives'           => esc_html__( 'Book Archives', 'booksawtheme' ),
            'attributes'         => esc_html__( 'Book Attributes', 'booksawtheme' ),
            'parent'             => esc_html__( 'Parent Book', 'booksawtheme' ),
            'all_items'          => esc_html__( 'All Books', 'booksawtheme' ),
            'add_new_item'       => esc_html__( 'Add New Book', 'booksawtheme' ),
            'add_new'            => esc_html__( 'Add New', 'booksawtheme' ),
            'new_item'           => esc_html__( 'New Book', 'booksawtheme' ),
            'edit_item'          => esc_html__( 'Edit Book', 'booksawtheme' ),
            'update_item'        => esc_html__( 'Update Book', 'booksawtheme' ),
            'view_item'          => esc_html__( 'View Book', 'booksawtheme' ),
            'view_items'         => esc_html__( 'View Books', 'booksawtheme' ),
            'search_items'       => esc_html__( 'Search Book', 'booksawtheme' ),
            'insert_into_item'   => esc_html__( 'Insert into book', 'booksawtheme' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this book', 'booksawtheme' ),
            'items_list'         => esc_html__( 'Books list', 'booksawtheme' ),
            'items_list_navigation' => esc_html__( 'Books list navigation', 'booksawtheme' ),
            'filter_items_list'  => esc_html__( 'Filter books list', 'booksawtheme' ),
        ),
        'public'              => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'rest_base'           => 'books',
        'capability_type'     => 'post',
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
        'taxonomies'          => array( 'book_category', 'book_author' ),
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'books' ),
        'menu_icon'           => 'dashicons-book',
    ) );
}
add_action( 'init', 'booksaw_register_post_types' );

/**
 * Register custom taxonomies for Books.
 *
 * @since 1.0.0
 */
function booksaw_register_taxonomies() {
    // Register Book Category taxonomy
    register_taxonomy( 'book_category', 'book', array(
        'labels'                => array(
            'name'              => esc_html_x( 'Categories', 'taxonomy general name', 'booksawtheme' ),
            'singular_name'     => esc_html_x( 'Category', 'taxonomy singular name', 'booksawtheme' ),
            'search_items'      => esc_html__( 'Search Categories', 'booksawtheme' ),
            'all_items'         => esc_html__( 'All Categories', 'booksawtheme' ),
            'parent_item'       => esc_html__( 'Parent Category', 'booksawtheme' ),
            'parent_item_colon' => esc_html__( 'Parent Category:', 'booksawtheme' ),
            'edit_item'         => esc_html__( 'Edit Category', 'booksawtheme' ),
            'update_item'       => esc_html__( 'Update Category', 'booksawtheme' ),
            'add_new_item'      => esc_html__( 'Add New Category', 'booksawtheme' ),
            'new_item_name'     => esc_html__( 'New Category Name', 'booksawtheme' ),
            'menu_name'         => esc_html__( 'Categories', 'booksawtheme' ),
        ),
        'public'                => true,
        'show_in_nav_menus'     => true,
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'hierarchical'          => true,
        'rewrite'               => array( 'slug' => 'book-category' ),
    ) );

    // Register Book Author taxonomy
    register_taxonomy( 'book_author', 'book', array(
        'labels'                => array(
            'name'              => esc_html_x( 'Authors', 'taxonomy general name', 'booksawtheme' ),
            'singular_name'     => esc_html_x( 'Author', 'taxonomy singular name', 'booksawtheme' ),
            'search_items'      => esc_html__( 'Search Authors', 'booksawtheme' ),
            'all_items'         => esc_html__( 'All Authors', 'booksawtheme' ),
            'parent_item'       => esc_html__( 'Parent Author', 'booksawtheme' ),
            'parent_item_colon' => esc_html__( 'Parent Author:', 'booksawtheme' ),
            'edit_item'         => esc_html__( 'Edit Author', 'booksawtheme' ),
            'update_item'       => esc_html__( 'Update Author', 'booksawtheme' ),
            'add_new_item'      => esc_html__( 'Add New Author', 'booksawtheme' ),
            'new_item_name'     => esc_html__( 'New Author Name', 'booksawtheme' ),
            'menu_name'         => esc_html__( 'Authors', 'booksawtheme' ),
        ),
        'public'                => true,
        'show_in_nav_menus'     => true,
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'hierarchical'          => false,
        'rewrite'               => array( 'slug' => 'book-author' ),
    ) );
}
add_action( 'init', 'booksaw_register_taxonomies' );

/**
 * Get the default book categories.
 *
 * @since 1.0.0
 * @return array
 */
function booksaw_get_default_book_categories() {
    return array(
        'Fiction',
        'Mystery & Thriller',
        'Fantasy',
        'Romance',
        'Historical Fiction',
        'Non-Fiction',
        'Biography & Memoir',
        'History',
        'Science & Technology',
        'Business',
        'Self-Help',
        'Psychological',
        'Personal Development',
        'Health & Wellness',
        'Travel',
        'Cookbooks',
        'Art & Design',
        'Kids & Family',
        'Young Adult',
        'Children\'s Books',
    );
}

/**
 * Insert default book categories when they are missing.
 *
 * @since 1.0.0
 */
function booksaw_insert_default_book_categories() {
    if ( ! taxonomy_exists( 'book_category' ) ) {
        return;
    }

    foreach ( booksaw_get_default_book_categories() as $category ) {
        if ( ! term_exists( $category, 'book_category' ) ) {
            wp_insert_term( $category, 'book_category' );
        }
    }
}
add_action( 'init', 'booksaw_insert_default_book_categories', 11 );

/**
 * Get the default book authors.
 *
 * @since 1.0.0
 * @return array
 */
function booksaw_get_default_book_authors() {
    return array(
        'J.K. Rowling',
        'Stephen King',
        'Agatha Christie',
        'George R. R. Martin',
        'Dan Brown',
        'Paulo Coelho',
        'Malcolm Gladwell',
        'Michelle Obama',
        'Yuval Noah Harari',
        'Brené Brown',
    );
}

/**
 * Insert default book authors when they are missing.
 *
 * @since 1.0.0
 */
function booksaw_insert_default_book_authors() {
    if ( ! taxonomy_exists( 'book_author' ) ) {
        return;
    }

    foreach ( booksaw_get_default_book_authors() as $author ) {
        if ( ! term_exists( $author, 'book_author' ) ) {
            wp_insert_term( $author, 'book_author' );
        }
    }
}
add_action( 'init', 'booksaw_insert_default_book_authors', 11 );

/**
 * Add custom meta boxes for books.
 *
 * @since 1.0.0
 */
function booksaw_add_book_meta_boxes() {
    add_meta_box(
        'book_details',
        esc_html__( 'Book Details', 'booksawtheme' ),
        'booksaw_book_details_callback',
        'book',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'booksaw_add_book_meta_boxes' );

/**
 * Book details meta box callback.
 *
 * @since 1.0.0
 */
function booksaw_book_details_callback( $post ) {
    wp_nonce_field( 'booksaw_book_nonce', 'booksaw_book_nonce' );
    
    $book_author = get_post_meta( $post->ID, '_book_author_name', true );
    $book_isbn = get_post_meta( $post->ID, '_book_isbn', true );
    $book_short_description = get_post_meta( $post->ID, '_book_short_description', true );
    $book_product_id = get_post_meta( $post->ID, '_book_product_id', true );
    $book_price = get_post_meta( $post->ID, '_book_price', true );
    $book_original_price = get_post_meta( $post->ID, '_book_original_price', true );
    $book_featured = get_post_meta( $post->ID, '_featured_book', true );
    $book_pages = get_post_meta( $post->ID, '_book_pages', true );
    $book_publisher = get_post_meta( $post->ID, '_book_publisher', true );
    $book_year = get_post_meta( $post->ID, '_book_year', true );
    $book_language = get_post_meta( $post->ID, '_book_language', true );
    $book_rating = get_post_meta( $post->ID, '_book_rating', true );
    $book_google_review_rating = get_post_meta( $post->ID, '_book_google_review_rating', true );
    $book_review_count = get_post_meta( $post->ID, '_book_review_count', true );
    $book_google_review_count = get_post_meta( $post->ID, '_book_google_review_count', true );
    $book_review_excerpt = get_post_meta( $post->ID, '_book_review_excerpt', true );
    $book_google_review_excerpt = get_post_meta( $post->ID, '_book_google_review_excerpt', true );
    ?>

    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 1rem;">
        <div>
            <label for="book_google_review_rating"><?php esc_html_e( 'Google Rating (0-5):', 'booksawtheme' ); ?></label>
            <input type="number" id="book_google_review_rating" name="book_google_review_rating" min="0" max="5" step="0.1" value="<?php echo esc_attr( $book_google_review_rating ); ?>" style="width:100%; padding: 8px;">
        </div>
        <div>
            <label for="book_google_review_count"><?php esc_html_e( 'Google Review Count:', 'booksawtheme' ); ?></label>
            <input type="number" id="book_google_review_count" name="book_google_review_count" min="0" value="<?php echo esc_attr( $book_google_review_count ); ?>" style="width:100%; padding: 8px;">
        </div>
    </div>
    <div style="margin-bottom: 1rem;">
        <label for="book_google_review_excerpt"><?php esc_html_e( 'Google Review Snippet:', 'booksawtheme' ); ?></label>
        <input type="text" id="book_google_review_excerpt" name="book_google_review_excerpt" value="<?php echo esc_attr( $book_google_review_excerpt ); ?>" style="width:100%; padding: 8px;" placeholder="<?php esc_attr_e( 'e.g. Excellent book with strong pacing', 'booksawtheme' ); ?>">
    </div>


    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 1rem;">
        <div>
            <label for="book_product_id"><?php esc_html_e( 'WooCommerce Product ID:', 'booksawtheme' ); ?></label>
            <input type="number" id="book_product_id" name="book_product_id" value="<?php echo esc_attr( $book_product_id ); ?>" style="width:100%; padding: 8px;" placeholder="<?php esc_attr_e( 'Product ID for cart', 'booksawtheme' ); ?>">
        </div>
        <div>
            <label for="book_price"><?php esc_html_e( 'Price ($):', 'booksawtheme' ); ?></label>
            <input type="number" id="book_price" name="book_price" value="<?php echo esc_attr( $book_price ); ?>" step="0.01" style="width:100%; padding: 8px;">
        </div>
    </div>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 1rem;">
        <div>
            <label for="book_original_price"><?php esc_html_e( 'Original Price ($):', 'booksawtheme' ); ?></label>
            <input type="number" id="book_original_price" name="book_original_price" value="<?php echo esc_attr( $book_original_price ); ?>" step="0.01" style="width:100%; padding: 8px;">
        </div>
        <div>
            <label for="book_pages"><?php esc_html_e( 'Pages:', 'booksawtheme' ); ?></label>
            <input type="number" id="book_pages" name="book_pages" value="<?php echo esc_attr( $book_pages ); ?>" style="width:100%; padding: 8px;">
        </div>
    </div>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 1rem;">
        <div>
            <label for="book_publisher"><?php esc_html_e( 'Publisher:', 'booksawtheme' ); ?></label>
            <input type="text" id="book_publisher" name="book_publisher" value="<?php echo esc_attr( $book_publisher ); ?>" style="width:100%; padding: 8px;">
        </div>
        <div>
            <label for="book_year"><?php esc_html_e( 'Publication Year:', 'booksawtheme' ); ?></label>
            <input type="number" id="book_year" name="book_year" value="<?php echo esc_attr( $book_year ); ?>" style="width:100%; padding: 8px;">
        </div>
    </div>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 1rem;">
        <div>
            <label for="book_language"><?php esc_html_e( 'Language:', 'booksawtheme' ); ?></label>
            <input type="text" id="book_language" name="book_language" value="<?php echo esc_attr( $book_language ); ?>" style="width:100%; padding: 8px;">
        </div>
        <div>
            <label for="book_rating"><?php esc_html_e( 'Rating (0-5):', 'booksawtheme' ); ?></label>
            <input type="number" id="book_rating" name="book_rating" min="0" max="5" step="0.5" value="<?php echo esc_attr( $book_rating ); ?>" style="width:100%; padding: 8px;">
        </div>
    </div>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 1rem;">
        <div>
            <label for="book_review_count"><?php esc_html_e( 'Review Count:', 'booksawtheme' ); ?></label>
            <input type="number" id="book_review_count" name="book_review_count" value="<?php echo esc_attr( $book_review_count ); ?>" min="0" style="width:100%; padding: 8px;">
        </div>
        <div>
            <label for="book_review_excerpt"><?php esc_html_e( 'Review Snippet:', 'booksawtheme' ); ?></label>
            <input type="text" id="book_review_excerpt" name="book_review_excerpt" value="<?php echo esc_attr( $book_review_excerpt ); ?>" style="width:100%; padding: 8px;" placeholder="<?php esc_attr_e( 'e.g. A must-read!', 'booksawtheme' ); ?>">
        </div>
    </div>
    <div style="margin-bottom: 1rem;">
        <label for="book_author_name"><?php esc_html_e( 'Author Name:', 'booksawtheme' ); ?></label>
        <input type="text" id="book_author_name" name="book_author_name" value="<?php echo esc_attr( $book_author ); ?>" style="width:100%; padding: 8px;">
    </div>
    <div style="margin-bottom: 1rem;">
        <label for="book_isbn"><?php esc_html_e( 'ISBN:', 'booksawtheme' ); ?></label>
        <input type="text" id="book_isbn" name="book_isbn" value="<?php echo esc_attr( $book_isbn ); ?>" style="width:100%; padding: 8px;">
    </div>
    <div style="margin-bottom: 1rem;">
        <label for="book_short_description"><?php esc_html_e( 'Short Description:', 'booksawtheme' ); ?></label>
        <textarea id="book_short_description" name="book_short_description" rows="4" style="width:100%; padding: 8px;"><?php echo esc_textarea( $book_short_description ); ?></textarea>
    </div>
    <div style="display:flex; align-items:center; gap: 1rem; margin-bottom: 1rem;">
        <label for="book_featured" style="margin:0; font-weight:600; display:inline-flex; align-items:center; gap:0.5rem;">
            <input type="checkbox" id="book_featured" name="book_featured" value="1" <?php checked( $book_featured, '1' ); ?> />
            <?php esc_html_e( 'Featured Book', 'booksawtheme' ); ?>
        </label>
    </div>
    <?php
}

/**
 * Save book meta data.
 *
 * @since 1.0.0
 */
function booksaw_save_book_meta( $post_id ) {
    if ( ! isset( $_POST['booksaw_book_nonce'] ) || ! wp_verify_nonce( $_POST['booksaw_book_nonce'], 'booksaw_book_nonce' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array(
        'book_author_name' => '_book_author_name',
        'book_isbn' => '_book_isbn',
        'book_short_description' => '_book_short_description',
        'book_product_id' => '_book_product_id',
        'book_price' => '_book_price',
        'book_original_price' => '_book_original_price',
        'book_pages' => '_book_pages',
        'book_publisher' => '_book_publisher',
        'book_year' => '_book_year',
        'book_language' => '_book_language',
        'book_rating' => '_book_rating',
        'book_google_review_rating' => '_book_google_review_rating',
        'book_review_count' => '_book_review_count',
        'book_google_review_count' => '_book_google_review_count',
        'book_review_excerpt' => '_book_review_excerpt',
        'book_google_review_excerpt' => '_book_google_review_excerpt',
    );

    foreach ( $fields as $post_field => $meta_key ) {
        if ( isset( $_POST[ $post_field ] ) ) {
            $value = $_POST[ $post_field ];
            if ( 'book_short_description' === $post_field ) {
                update_post_meta( $post_id, $meta_key, sanitize_textarea_field( $value ) );
            } else {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( $value ) );
            }
        }
    }

    if ( isset( $_POST['book_featured'] ) ) {
        update_post_meta( $post_id, '_featured_book', '1' );
    } else {
        update_post_meta( $post_id, '_featured_book', '0' );
    }

    if ( ! isset( $_POST['book_short_description'] ) || '' === trim( wp_unslash( $_POST['book_short_description'] ) ) ) {
        $default_description = booksaw_get_book_short_description( $post_id );
        if ( $default_description ) {
            update_post_meta( $post_id, '_book_short_description', sanitize_textarea_field( $default_description ) );
        }
    }
}
add_action( 'save_post_book', 'booksaw_save_book_meta' );

/**
 * Add custom image sizes.
 *
 * @since 1.0.0
 */
function booksaw_add_image_sizes() {
    add_image_size( 'book-cover', 250, 350, true );
    add_image_size( 'book-featured', 800, 600, true );
    add_image_size( 'book-thumbnail', 150, 200, true );
}
add_action( 'after_setup_theme', 'booksaw_add_image_sizes' );

/**
 * Ensure the book archive displays all books.
 *
 * @since 1.0.0
 * @param WP_Query $query Query instance.
 */
function booksaw_show_all_books_in_archive( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'book' ) ) {
        $query->set( 'posts_per_page', -1 );
    }
}
add_action( 'pre_get_posts', 'booksaw_show_all_books_in_archive' );

/**
 * Get book details.
 *
 * @since 1.0.0
 */
function booksaw_get_book_detail( $post_id, $key ) {
    $meta_key = '_book_' . str_replace( '-', '_', $key );
    return get_post_meta( $post_id, $meta_key, true );
}

/**
 * Display star rating.
 *
 * @since 1.0.0
 */
function booksaw_display_rating( $rating ) {
    if ( ! $rating ) {
        return;
    }
    
    $rating = floatval( $rating );
    $full_stars = floor( $rating );
    $has_half = ( $rating - $full_stars ) >= 0.5;
    
    echo '<div class="book-rating">';
    for ( $i = 0; $i < 5; $i++ ) {
        if ( $i < $full_stars ) {
            echo '<span class="star">★</span>';
        } elseif ( $i === $full_stars && $has_half ) {
            echo '<span class="star">✶</span>';
        } else {
            echo '<span class="star" style="color: #ddd;">★</span>';
        }
    }
    echo '<span style="margin-left: 5px; color: #666;">(' . esc_html( $rating ) . ')</span>';
    echo '</div>';
}

/**
 * Add admin styles.
 *
 * @since 1.0.0
 */
function booksaw_admin_styles() {
    wp_enqueue_style( 'booksaw-admin', BOOKSAW_URI . '/assets/css/admin.css', array(), BOOKSAW_VERSION );
}
add_action( 'admin_enqueue_scripts', 'booksaw_admin_styles' );

/**
 * Custom excerpt length.
 *
 * @since 1.0.0
 */
function booksaw_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'booksaw_excerpt_length' );

/**
 * Custom excerpt more.
 *
 * @since 1.0.0
 */
function booksaw_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'booksaw_excerpt_more' );
