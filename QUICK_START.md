# Quick Start Guide for BookSaw Theme

## Installation Steps

### 1. Activate the Theme
- Go to WordPress Dashboard → Appearance → Themes
- Look for "BookSaw - Professional Bookstore Theme"
- Click "Activate"

### 2. Create Required Pages
Create these pages to set up your bookstore:

**Home/Front Page:**
- Create a new page titled "Home"
- Leave content empty (it's auto-filled by front-page.php)

**Shop/Books Archive:**
- Create a page titled "Books" (optional, archives auto-generate at /books/ or /book-category/)

**About Page:**
- Create a page titled "About Us" with your store information

**Contact Page:**
- Create a page titled "Contact" and add contact form with a plugin

**Blog/Articles:**
- Use default WordPress posts functionality

### 3. Set Up Menus
- Go to Appearance → Menus
- Create a new menu with these items:
  - Home (point to home page)
  - About (link to About page)
  - Shop or Books (link to /books/)
  - Articles (link to /articles/, or post archive)
  - Contact (link to Contact page)
- Set this menu as "Primary Menu" in menu settings

### 4. Configure Reading Settings
- Go to Settings → Reading
- Change "Front page displays" to "A static page"
- Select your "Home" page as the front page

### 5. Add Books
- Go to Books → Add New
- Fill in all fields:
  - **Primary Content**: Title, Featured Image, Description/Content
  - **Categories & Authors**: Set book category and author
  - **Book Details** (Meta Box):
    - Author Name
    - ISBN
    - Price
    - Original Price (if on sale)
    - Pages
    - Publisher
    - Publication Year
    - Language
    - Rating (0-5)

### 6. Create Book Categories & Authors
- Before adding books, create categories:
  - Books → Categories
  - Add: Fiction, Non-Fiction, Science, History, Business, etc.

- Create authors:
  - Books → Authors
  - Add author names

### 7. Optional: Enable WooCommerce
For full e-commerce:
1. Install WooCommerce plugin
2. Configure WooCommerce settings
3. The "Add to Cart" buttons will activate automatically

## Customization Quick Tips

### Change Logo
- Go to Appearance → Customize
- Upload your bookstore logo (recommended: square, 200x200px or larger)

### Change Colors
- Edit `style.css` and find the `:root` section
- Update color variables:
  - `--primary-color`: Main theme color
  - `--secondary-color`: Accent color
  - `--accent-color`: Highlight color

### Add Sidebar Content
- Go to Appearance → Widgets
- Add widgets to "Primary Sidebar" section
- Useful widgets: Latest Books (custom), Categories, Authors, Search

### Featured Books
- To mark a book as featured, add this custom field:
  - Field Name: `_featured_book`
  - Value: `1`
- Featured books appear on homepage in the Featured Books section

## Troubleshooting

### Books Not Showing on Archive
- Check that Books have categories and/or authors assigned
- Go to Books → All Books and verify they're published

### Homepage Not Displaying Front Page Content
- Verify you've set a static front page in Settings → Reading
- Check that a "Home" page exists with at least a title

### Missing Images
- Go to Books and ensure featured images are uploaded
- Recommended image size: 250x350px for book covers

### Navigation Menu Not Showing
- Create a menu and assign it as "Primary Menu" in Appearance → Menus
- Verify the Primary Menu location is set

## Default Content Areas

### Homepage Sections (in order):
1. **Hero Section** - Welcome banner
2. **Featured Books** - Auto-populated from books with _featured_book meta
3. **Books with Offer** - Books with original prices (showing discounts)
4. **Newsletter Section** - Email signup
5. **Latest Articles** - Recent blog posts

### Navigation
- Primary Menu (customizable)
- Header Icons: Search, Cart (if WooCommerce active), Account

### Footer
- About section
- Quick Links
- Book Categories (top 5)
- Contact Info (shows static text, can be customized in footer.php)

## Important Paths

- Shop/Books Archive: `/books/` or `/book-category/`
- Single Book: `/books/book-title/`
- Author Books: `/book-author/author-name/`
- Category Books: `/book-category/category-name/`

## Common Customizations

### Change Site Title and Tagline
- Settings → General
- Update "Site Title" and "Tagline"

### Change Tagline Appearance
- Enable/disable by editing `header.php`
- Look for `.site-description` display property

### Add Custom Widgets
- Create custom widget in child theme's `inc/widgets.php`
- Register in `functions.php` using `register_sidebar()`

### Change Book Card Layout
- Edit `template-parts/content-book.php`
- Modify grid layout in `style.css` .books-grid section

## Next Steps

1. **Set up a staging site** to test changes before deploying
2. **Install essential plugins**:
   - Yoast SEO (for search optimization)
   - Contact Form 7 (for contact pages)
   - WooCommerce (for e-commerce)
3. **Optimize images** before uploading
4. **Test on mobile devices** to ensure responsive design works
5. **Set up backups** to protect your data

## Support Resources

- WordPress Documentation: https://wordpress.org/documentation/
- Theme PHP Functions: See comments in `functions.php`
- CSS Customization: See variables in `style.css`
- Template Structure: See individual template files

---

**Happy bookstore building!** 📚
