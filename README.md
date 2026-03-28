# MuiTool - Online Tool Platform

A modern, multilingual online tool platform built with Laravel, designed for technology professionals. Features a minimalist design, comprehensive SEO optimization, and full internationalization support. V1 LARAVEL

## Features

- **Multilingual Support**: English, Portuguese (Brazil), and Spanish
- **SEO Optimized**: Complete meta tags, Open Graph, Twitter Cards, and JSON-LD structured data
- **Minimalist Design**: Clean, modern interface with Tailwind CSS
- **Scalable Architecture**: Following Laravel and PHP best practices
- **Database-driven Content**: Flexible category and tool management
- **Automatic Sitemap**: Dynamic sitemap generation for all pages and locales

## Technology Stack

- **Framework**: Laravel 11.x
- **Frontend**: Tailwind CSS v4, Vite
- **Database**: SQLite (configurable to MySQL/PostgreSQL)
- **SEO**: Spatie Laravel Sitemap, Artesaos SEOTools
- **PHP**: 8.2+

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 20.19+ or 22.12+
- SQLite (or MySQL/PostgreSQL)

### Setup Steps

1. **Clone the repository**

   ```bash
   cd c:\Users\Varga\Herd\muitool
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install Node dependencies**

   ```bash
   npm install
   ```

4. **Configure environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run migrations and seeders**

   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Build assets**

   ```bash
   npm run build
   ```

7. **Generate sitemap**

   ```bash
   php artisan sitemap:generate
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see the application.

## Project Structure

### Database Schema

**categories**

- id, slug (unique), icon, order, timestamps

**category_translations**

- id, category_id (FK), locale, name, description, timestamps
- unique: (category_id, locale)

**tools**

- id, category_id (FK), slug (unique), icon, view_component, is_active, meta_data (json), timestamps
- indexes: (slug, is_active)
- soft deletes enabled

**tool_translations**

- id, tool_id (FK), locale, name, short_description, description, meta_title, meta_description, faq (json), use_cases (json), timestamps
- unique: (tool_id, locale)

### Key Directories

```
app/
├── Console/Commands/
│   └── GenerateSitemap.php          # Sitemap generation command
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php       # Homepage with categories
│   │   └── ToolController.php       # Individual tool pages
│   └── Middleware/
│       └── SetLocale.php            # Language detection middleware
└── Models/
    ├── Category.php                 # Category model
    ├── CategoryTranslation.php      # Category translations
    ├── Tool.php                     # Tool model
    └── ToolTranslation.php          # Tool translations

resources/
├── css/
│   └── app.css                      # Tailwind CSS configuration
├── views/
│   ├── components/
│   │   ├── category-card.blade.php  # Category card component
│   │   └── json-formatter.blade.php # Example tool component
│   ├── layouts/
│   │   ├── app.blade.php            # Main layout
│   │   └── partials/
│   │       ├── header.blade.php     # Header with navigation
│   │       ├── footer.blade.php     # Footer
│   │       └── meta.blade.php       # SEO meta tags
│   ├── tools/
│   │   └── show.blade.php           # Tool detail page
│   └── home.blade.php               # Homepage

lang/
├── en/                              # English translations
├── pt_BR/                           # Portuguese (Brazil) translations
└── es/                              # Spanish translations
```

## Routes

- `GET /` - Homepage (default locale)
- `GET /{locale}` - Homepage with specific locale (en, pt_BR, es)
- `GET /tools/{slug}` - Tool page (default locale)
- `GET /{locale}/tools/{slug}` - Tool page with specific locale

## SEO Features

### Meta Tags

- Dynamic title, description, and keywords per page
- Canonical URLs
- Alternate language tags (hreflang)

### Social Media

- Open Graph tags for Facebook
- Twitter Card tags
- Custom images per tool

### Structured Data

- JSON-LD for SoftwareApplication
- Schema.org markup

### Sitemap

- Automatic generation with `php artisan sitemap:generate`
- Includes all pages in all locales
- Proper priority and change frequency

## Internationalization

### Available Locales

- `en` - English
- `pt_BR` - Portuguese (Brazil)
- `es` - Spanish

### Adding New Languages

1. Create language directory in `lang/`
2. Add translation files: `seo.php`, `common.php`
3. Update `SetLocale` middleware to include new locale
4. Add translations to database for categories and tools
5. Update routes to include new locale pattern

## Creating New Tools

### 1. Create Tool Component

Create a new Blade component in `resources/views/components/`:

```blade
<!-- resources/views/components/my-tool.blade.php -->
<div class="my-tool">
    <!-- Tool interface here -->
</div>
```

### 2. Add Tool to Database

```php
$tool = Tool::create([
    'category_id' => 1,
    'slug' => 'my-tool',
    'icon' => 'icon.svg',
    'view_component' => 'my-tool',
    'is_active' => true,
]);

// Add translations for each locale
ToolTranslation::create([
    'tool_id' => $tool->id,
    'locale' => 'en',
    'name' => 'My Tool',
    'short_description' => 'Brief description',
    'description' => 'Full description',
    'meta_title' => 'SEO Title',
    'meta_description' => 'SEO Description',
    'faq' => [...],
    'use_cases' => [...],
]);
```

### 3. Regenerate Sitemap

```bash
php artisan sitemap:generate
```

## Performance Optimization

### Implemented Optimizations

- **Eager Loading**: Prevents N+1 queries with `with()` relationships
- **Database Indexes**: On frequently queried columns (slug, is_active)
- **Caching**: Ready for `Cache::remember()` on heavy queries
- **Asset Optimization**: Vite for bundling and minification
- **Lazy Loading**: Images load as needed

### Recommended Production Settings

1. **Enable Caching**

   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Use Production Database**
   Update `.env` to use MySQL or PostgreSQL

3. **Enable OPcache**
   Configure PHP OPcache for better performance

4. **Use CDN**
   Serve static assets from a CDN

## Development

### Code Style

- Follows PSR-12 coding standards
- Use `composer format` to format code (if configured)

### Running Tests

```bash
php artisan test
```

### Development Server

```bash
npm run dev  # Watch for asset changes
php artisan serve  # Start Laravel server
```

## Deployment

### Production Checklist

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Configure production database
4. Run migrations: `php artisan migrate --force`
5. Build assets: `npm run build`
6. Cache configuration: `php artisan optimize`
7. Generate sitemap: `php artisan sitemap:generate`
8. Set proper file permissions
9. Configure web server (Nginx/Apache)

### Scheduled Tasks

Add to crontab for automatic sitemap updates:

```bash
0 0 * * * cd /path/to/project && php artisan sitemap:generate
```

## Contributing

When contributing to this project:

1. Follow PSR-12 coding standards
2. Write meaningful commit messages
3. Add tests for new features
4. Update documentation as needed
5. Ensure all tests pass before submitting

## License

This project is open-sourced software licensed under the MIT license.

## Support

For issues and questions, please open an issue on the repository.

---

**Built with ❤️ using Laravel and Tailwind CSS**
