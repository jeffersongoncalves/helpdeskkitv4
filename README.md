<div class="filament-hidden">

![HelpDeskKit v4](https://raw.githubusercontent.com/jeffersongoncalves/helpdeskkitv4/main/art/jeffersongoncalves-helpdeskkitv4.png)

</div>

# HelpDesk Kit - Start Kit Filament 4.x and Laravel 12.x

## About HelpDesk Kit

HelpDesk Kit is a robust starter kit built on Laravel 12.x and Filament 4.x, designed to accelerate the development of help desk and support ticket systems with a ready-to-use multi-panel structure and integrated ticket management.

## Features

- **Laravel 12.x** - The latest version of the most elegant PHP framework
- **Filament 4.x** - Powerful and flexible admin framework
- **Help Desk System** - Full-featured ticket management powered by `filament-help-desk`
    - Ticket creation, assignment, and tracking
    - Departments and categories
    - Canned responses
    - Email channel integration (inbound/outbound)
    - Ticket history and watchers
    - File attachments
- **Multi-Panel Structure** - Includes four pre-configured panels:
    - **Admin Panel** (`/admin`) - Full system administration, user/operator management, help desk configuration
    - **Operator Panel** (`/operator`) - Dedicated panel for support operators to manage assigned tickets
    - **App Panel** (`/app`) - For authenticated users to create and track support tickets
    - **Guest Panel** (`/`) - Public frontend interface for visitors
- **Multi-Guard Authentication** - Three separate auth guards with dedicated models:
    - `Admin` - Administrative access with impersonation support
    - `Operator` - Support operator access (ticket management only)
    - `User` - Application user access (ticket creation)
- **Environment Configuration** - Centralized configuration through the `config/helpdeskkit.php` file

## System Requirements

- PHP 8.2 or higher
- Composer
- Node.js and PNPM

## Installation

Clone the repository
``` bash
laravel new my-app --using=jeffersongoncalves/helpdeskkitv4 --database=mysql
```

### Using filakit CLI

Or use [filakit CLI](https://github.com/jeffersongoncalves/filakit-cli) for a simplified setup:

```bash
filakit new my-app --kit=jeffersongoncalves/helpdeskkitv4
```

> Install filakit CLI: `composer global require jeffersongoncalves/filakit-cli`

###  Easy Installation

HelpDesk Kit can be easily installed using the following command:

```bash
php install.php
```

This command automates the installation process by:
- Installing Composer dependencies
- Setting up the environment file
- Generating application key
- Setting up the database
- Running migrations
- Installing Node.js dependencies
- Building assets
- Configuring Herd (if used)

### Manual Installation

Install JavaScript dependencies
``` bash
pnpm install
```
Install Composer dependencies
``` bash
composer install
```
Set up environment
``` bash
cp .env.example .env
php artisan key:generate
```

Configure your database in the .env file

Run migrations
``` bash
php artisan migrate
```
Run the server
``` bash
php artisan serve
```

## Installation with Docker

Clone the repository
```bash
laravel new my-app --using=jeffersongoncalves/helpdeskkitv4 --database=mysql
```

Move into the project directory
```bash
cd my-app
```

Install Composer dependencies
```bash
composer install
```

Set up environment
```bash
cp .env.example .env
```

Configuring custom ports may be necessary if you have other services running on the same ports.

```bash
# Application Port (ex: 8080)
APP_PORT=8080

# MySQL Port (ex: 3306)
FORWARD_DB_PORT=3306

# Redis Port (ex: 6379)
FORWARD_REDIS_PORT=6379

# Mailpit Port (ex: 1025)
FORWARD_MAILPIT_PORT=1025
```

Start the Sail containers
```bash
./vendor/bin/sail up -d
```
You won't need to run `php artisan serve`, as Laravel Sail automatically handles the development server within the container.

Attach to the application container
```bash
./vendor/bin/sail shell
```

Generate the application key
```bash
php artisan key:generate
```

Install JavaScript dependencies
```bash
pnpm install
```

## Authentication Structure

HelpDesk Kit comes pre-configured with a multi-guard authentication system that supports three types of users:

| Guard | Model | Panel | Path | Description |
|-------|-------|-------|------|-------------|
| `admin` | `Admin` | Admin | `/admin` | Full system administration |
| `operator` | `Operator` | Operator | `/operator` | Support ticket management |
| `web` | `User` | App | `/app` | User-facing ticket creation |

### Default Credentials (after seeding)

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@helpdeskkit.com` | `password` |
| Operator | `operator@helpdeskkit.com` | `password` |
| User | `user@helpdeskkit.com` | `password` |

## Help Desk System

HelpDesk Kit includes the `filament-help-desk` plugin, providing a complete support ticket system:

### Admin Panel (`/admin`)
- Manage all tickets, departments, categories, and canned responses
- Configure email channels for inbound/outbound ticket communication
- Manage operators and assign them to departments
- View ticket statistics and analytics widgets

### Operator Panel (`/operator`)
- View and manage assigned tickets
- Change ticket status and priority
- Add comments and attachments
- Bulk assign and status change operations
- Ticket statistics by status widget

### App Panel (`/app`)
- Create new support tickets
- Track ticket status and history
- View operator responses
- Attach files to tickets

## Development

``` bash
# Run the development server with logs, queues and asset compilation
composer dev

# Or run each component separately
php artisan serve
php artisan queue:listen --tries=1
pnpm run dev
```

## Customization

### Panel Configuration

Panels can be customized through their respective providers:

- `app/Providers/Filament/AdminPanelProvider.php`
- `app/Providers/Filament/OperatorPanelProvider.php`
- `app/Providers/Filament/AppPanelProvider.php`
- `app/Providers/Filament/GuestPanelProvider.php`

Alternatively, these settings are also consolidated in the `config/helpdeskkit.php` file for easier management.

### Panel Toggling

Each panel can be enabled or disabled in `config/helpdeskkit.php`:

```php
'admin_panel_enabled' => true,
'operator_panel_enabled' => true,
'app_panel_enabled' => true,
'guest_panel_enabled' => true,
```

### Themes and Colors

Each panel has its own color scheme:

| Panel | Color | Theme CSS |
|-------|-------|-----------|
| Admin | Amber | `resources/css/filament/admin/theme.css` |
| Operator | Blue | `resources/css/filament/operator/theme.css` |
| App | Green | `resources/css/filament/app/theme.css` |
| Guest | - | `resources/css/filament/guest/theme.css` |

### Help Desk Configuration

- `config/help-desk.php` - Core help desk settings (models, ticket settings, email, notifications)
- `config/filament-help-desk.php` - Filament panel-specific settings (navigation, resources, slugs)

### Configuration File

The `config/helpdeskkit.php` file centralizes the configuration of the starter kit, including:

- Panel routes
- Middleware for each panel
- Branding options (logo, colors)
- Authentication guards

## User Profile — joaopaulolndev/filament-edit-profile

This project already comes with the Filament Edit Profile plugin integrated for the Admin, Operator, and App panels. It adds a complete profile editing page with avatar, language, theme color, security (tokens, MFA), browser sessions, and email/password change.

- Routes (defaults in this project):
  - Admin: /admin/my-profile
  - Operator: /operator/my-profile
  - App: /app/my-profile
- Navigation: by default, the page does not appear in the menu (shouldRegisterNavigation(false)). If you want to show it in the sidebar menu, change it to true in the panel provider.

Where to configure
- Panel providers
  - Admin: app/Providers/Filament/AdminPanelProvider.php
  - Operator: app/Providers/Filament/OperatorPanelProvider.php
  - App: app/Providers/Filament/AppPanelProvider.php
  In these files you can adjust:
  - ->slug('my-profile') to change the URL (e.g., 'profile')
  - ->setTitle('My Profile') and ->setNavigationLabel('My Profile')
  - ->setNavigationGroup('Group Profile'), ->setIcon('heroicon-o-user'), ->setSort(10)
  - ->shouldRegisterNavigation(true|false) to show/hide it in the menu
  - Shown forms: ->shouldShowEmailForm(), ->shouldShowLocaleForm([...]), ->shouldShowThemeColorForm(), ->shouldShowSanctumTokens(), ->shouldShowMultiFactorAuthentication(), ->shouldShowBrowserSessionsForm(), ->shouldShowAvatarForm()

- General settings: config/filament-edit-profile.php
  - locales: language options available on the profile page
  - locale_column: column used in your model for language/locale (default: locale)
  - theme_color_column: column for theme color (default: theme_color)
  - avatar_column: avatar column (default: avatar_url)
  - disk: storage disk used for the avatar (default: public)
  - visibility: file visibility (default: public)

Migrations and models
- The required columns are already included in this kit's default migrations (users, admins, and operators): avatar_url, locale and theme_color, using the names defined in config/filament-edit-profile.php.
- The App\Models\User, App\Models\Admin, and App\Models\Operator models already read the avatar using the plugin configuration (getFilamentAvatarUrl).

Avatar storage
- Make sure the filesystem disk is configured and that the storage link exists:
  php artisan storage:link
- Adjust the disk and visibility in the config file according to your infrastructure.

Quick access
- Via direct URL: /admin/my-profile, /operator/my-profile, or /app/my-profile
- To make it visible in the sidebar navigation, set shouldRegisterNavigation(true) in the respective Provider.

Reference
- Plugin repository: https://github.com/joaopaulolndev/filament-edit-profile

## Resources

HelpDesk Kit includes support for:

- Help desk ticket management system
- User, admin, and operator management
- Multi-guard authentication system (3 guards)
- Multi-panel Filament structure (4 panels)
- Tailwind CSS integration
- Database queue configuration
- Customizable panel routing and branding
- Email channel integration for ticket communication
- Database notifications

## License

This project is licensed under the [MIT License](LICENSE).

## Credits

Developed by [Jefferson Goncalves](https://github.com/jeffersongoncalves).
