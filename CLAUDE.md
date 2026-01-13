# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

### Development
```bash
php artisan serve          # Start the Laravel development server
npm run dev                # Start Vite dev server for assets (run in parallel with artisan serve)
```

### Testing
```bash
./vendor/bin/pest          # Run all tests
./vendor/bin/pest --filter="test name"  # Run a specific test
./vendor/bin/pest tests/Feature/ExampleTest.php  # Run a specific test file
```

### Database
```bash
php artisan migrate        # Run migrations
php artisan migrate:fresh  # Drop all tables and re-run migrations
php artisan db:seed        # Run database seeders
```

### Code Quality
```bash
./vendor/bin/pint          # Run Laravel Pint code formatter
```

## Architecture

This is a personal portfolio website built with Laravel 11 and Livewire Volt.

### Key Technologies
- **Livewire Volt**: Single-file Livewire components that combine PHP and Blade in one file
- **Pest**: Testing framework (uses `tests/Pest.php` for global configuration)
- **Tailwind CSS**: Styling via Vite

### Project Structure
- **Volt components** are stored in `resources/views/livewire/` and optionally `resources/views/pages/` (configured in `VoltServiceProvider`)
- **Routes** use Volt's functional routing: `Volt::route('/', 'home')` in `routes/web.php`
- **Blade components** in `resources/views/components/` (header, footer, project-card)
- **Layout** at `resources/views/layouts/app.blade.php`

### Data Model
- `Project` model with JSON casts for `details` and `roles` fields
- Uses SQLite database (`database/database.sqlite`)
