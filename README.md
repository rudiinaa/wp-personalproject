# BookSaw - Professional WordPress Bookstore Theme

A modern, elegant WordPress theme designed specifically for online bookstores. Inspired by contemporary design principles and optimized for user experience.

## Features

### Core Features
- **Custom Book Post Type**: Manage books with detailed metadata including ISBN, price, rating, pages, publisher, etc.
- **Book Categories & Authors**: Organize books by category and author with dedicated archive pages
- **Professional Design**: Clean, modern design inspired by premium bookstore websites
- **WooCommerce Ready**: Compatible with WooCommerce for full e-commerce functionality
- **Responsive Design**: Mobile-first, fully responsive design that looks great on all devices
- **SEO Optimized**: Built with search engine optimization in mind

### Design Features
- **Featured Books Section**: Showcase your best books on the homepage
- **Books with Offers**: Highlight discounted or special books with automatic discount calculation
- **Book Details**: Comprehensive book information including ISBN, pages, publisher, language, and rating
- **Book Card Display**: Attractive card-based grid layout for book displays
- **Newsletter Subscription**: Built-in newsletter signup section
- **Latest Articles**: Blog section for book reviews and literary discussions
- **Author Pages**: Dedicated pages showing all books by a specific author
- **Related Books**: Automatically display related books on book detail pages

### Technical Features
- **Custom Meta Boxes**: Easy-to-use admin interface for book details
- **Image Sizes**: Optimized image sizes for book covers (`book-cover`, `book-featured`, `book-thumbnail`)
- **Widget Areas**: Sidebar widgets for additional content and functionality
- **Navigation Menus**: Primary and footer navigation menus
- **Admin Styling**: Custom admin panel with theme-specific styling
- **JavaScript Enhancements**: Smooth scrolling, search functionality, newsletter form validation
- **Clean Code**: Well-organized, documented PHP code following WordPress coding standards

## Installation

1. **Upload Theme**:
   - Download/Extract the theme folder
   - Upload to `/wp-content/themes/` directory
   - Alternatively, upload the ZIP file through WordPress admin

2. **Activate Theme**:
   - Go to WordPress Admin → Appearance → Themes
   - Find "BookSaw" theme
   - Click "Activate"

3. **Configure Site**:
   - Set a static front page (Appearance → Reading → Front Page)
   - Create a page called "Home" and set it as the front page
   - Set up navigation menus (Appearance → Menus)

4. **Add Content**:
   - Go to Books → Add New to start adding books
   - Fill in book details meta box (Author, ISBN, Price, Rating, etc.)
   - Add book categories and authors through Books taxonomy sections

## Adding Books

### Book Meta Fields
- **Author Name**: The book author's name
- **ISBN**: International Standard Book Number
- **Price**: Current selling price
- **Original Price**: Original price (for discount display)
- **Pages**: Number of pages
- **Publisher**: Publishing company name
- **Publication Year**: Year the book was published
- **Language**: Language the book is published in
- **Rating**: Book rating (0-5 stars)

### Book Taxonomies
- **Book Categories**: Organize books by genre or category (Fiction, Science, History, etc.)
- **Book Authors**: Tag books by author (enables author archive pages)

## Customization

### Colors
Edit the CSS custom properties in `style.css`:
```css
:root {
  --primary-color: #2c2c2c;
  --secondary-color: #8B7355;
  --accent-color: #D4A574;
  --light-bg: #F5F3F0;
  /* ... more colors ... */
}
```

### Fonts
The theme uses 'Segoe UI', Tahoma, Geneva, Verdana system fonts. To use custom fonts, add them via `wp_enqueue_style()` in `functions.php`.

### Templates
- `front-page.php` - Homepage layout
- `index.php` - Blog/archive pages
- `single-book.php` - Individual book page
- `archive-book.php` - Book listing pages
- `page.php` - Regular pages
- `single.php` - Blog posts
- `search.php` - Search results
- `404.php` - Not found page

## WooCommerce Integration

To enable full e-commerce functionality:

1. Install and activate WooCommerce plugin
2. Configure WooCommerce settings
3. Update book meta with prices
4. The "Add to Cart" buttons will work with WooCommerce

**Note**: The current theme has "Add to Cart" functionality ready for WooCommerce integration.

## Theme Structure

```
wp-personalproject/
├── style.css              # Main stylesheet
├── functions.php          # Theme functions
├── header.php             # Header template
├── footer.php             # Footer template
├── index.php              # Main template
├── front-page.php         # Homepage
├── page.php               # Page template
├── single.php             # Single post template
├── single-book.php        # Single book template
├── archive.php            # Archive template
├── archive-book.php       # Book archive
├── search.php             # Search template
├── 404.php                # 404 template
├── template-parts/        # Template parts
│   ├── content.php
│   ├── content-book.php
│   └── content-none.php
├── assets/
│   ├── css/
│   │   ├── responsive.css
│   │   └── admin.css
│   ├── js/
│   │   └── main.js
│   └── images/
└── inc/                   # Additional includes (for future use)
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance Tips

1. **Optimize Images**: Use appropriately sized images for book covers
2. **Use Caching**: Install a caching plugin for better performance
3. **Lazy Load**: Consider lazy loading for book images using plugins
4. **Minify CSS/JS**: Production versions should be minified

## Support & Documentation

For issues or questions:
1. Check the code comments in template files
2. Review WordPress coding standards: https://developer.wordpress.org/
3. Consult the theme documentation in functions.php

## License

GPL v2 or later

## Credits

Designed specifically for professional bookstores with modern web standards and best practices.

---

**Version**: 1.0.0  
**Author**: Your Name  
**Last Updated**: 2026
