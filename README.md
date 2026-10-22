# Platinum Interiors LLC & Platoplus Design & Fitout LLC

[![PHP Version](https://img.shields.io/badge/PHP-7.4%20%7C%208.x-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/Database-MySQL%20%2F%20MariaDB-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Frontend-Bootstrap%205-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Apache](https://img.shields.io/badge/Server-Apache%20%2F%20LiteSpeed-D22128?logo=apache&logoColor=white)](https://httpd.apache.org/)

Official dynamic website and custom Content Management System (CMS) backend for **Platinum Interiors LLC** (Ajman, UAE) and **Platoplus Design & Fitout LLC** (Dubai, UAE), delivering custom interior joinery, turnkey fit-out, and design solutions across the Middle East.

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
  - [Public Portal](#public-portal)
  - [Admin Dashboard (CMS)](#admin-dashboard-cms)
- [Technology Stack](#-technology-stack)
- [Project Architecture](#-project-architecture)
- [Getting Started & Local Setup](#-getting-started--local-setup)
  - [Prerequisites](#prerequisites)
  - [Installation Steps](#installation-steps)
  - [Database Configuration](#database-configuration)
  - [PHP Runtime Configuration](#php-runtime-configuration)
- [URL Routing & Server Configuration](#-url-routing--server-configuration)
- [Database Schema Overview](#-database-schema-overview)
- [Security & Rate Limiting](#-security--rate-limiting)
- [Third-Party Integrations](#-third-party-integrations)
- [Troubleshooting & FAQs](#-troubleshooting--faqs)

---

## 🏢 Overview

The platform consists of two primary layers:
1. **Public Website**: A high-performance, mobile-responsive corporate portal showcasing luxury commercial and residential interior design projects, specialized services, team profiles, client listings, and company milestones.
2. **Custom Admin CMS**: A centralized administration portal enabling non-technical operators to manage content, media galleries, SEO metadata, company contact information, and incoming client inquiries.

---

## ✨ Key Features

### Public Portal
- **Hero & Carousel Showcase**: Interactive visual banner sliders presenting brand divisions and project highlights.
- **Project Portfolio with Dynamic Slugs**:
  - Filterable by categories.
  - Dedicated project view pages (`/project/<keyword>`) with pagination.
  - High-resolution image galleries with LightGallery lightbox integration (zoom, thumbnails).
- **Service Catalog**: Detail cards showcasing turnkey fit-out, joinery, upholstery, gypsum works, and metal fabrication.
- **Company Information**: About story, leadership & staff roster, corporate metrics counter, and trusted client logo grid.
- **Blogs & Publications**: Article indexing and detailed view pages (`/blog/<keyword>`).
- **Contact & Inquiry System**:
  - Direct inquiry form with Google reCAPTCHA verification.
  - Automated HTML email dispatch via PHPMailer.
  - Contact submissions saved directly to the database.

### Admin Dashboard (CMS)
- **Executive Analytics**: Real-time traffic metrics via Google Analytics Data API (`BetaAnalyticsDataClient`).
- **Category Management**: Full CRUD for project categories and custom URL keywords.
- **Project Portfolio Manager**:
  - Multi-image drag-and-drop batch upload.
  - Automated image optimization and compression (JPEG, WebP, PNG).
  - Custom SEO keywords, locations, descriptions, and ALT text tags.
- **Service & Blog Manager**: Creation, modification, and deletion of corporate articles and service offerings.
- **Testimonials & Clients**: Client endorsements and logo manager.
- **Team Management**: Staff roster with designations and portrait imagery.
- **Settings & Global SEO**:
  - Live configuration of contact emails, phone numbers, and WhatsApp links.
  - Global SEO meta descriptions, keywords, and social links (Facebook, Instagram, LinkedIn, Pinterest, YouTube).
- **Enquiry Inbox**: Centralized dashboard to view customer contact submissions.

---

## 🛠 Technology Stack

### Backend
- **PHP**: Procedural PHP with `mysqli` extension.
- **MySQL / MariaDB**: Relational database storage.
- **Composer**: Package dependency management (`admin/composer.json`).
- **PHPMailer**: Transactional email delivery over SMTP.
- **Google Analytics Client**: REST-based Google Analytics Data v1beta client.

### Frontend
- **HTML5 & CSS3**: Custom styles, responsive grid, and typography.
- **Bootstrap 5**: Modern layout components and modals.
- **jQuery 3.7.1**: DOM manipulation and AJAX interactions.
- **LightGallery**: Interactive lightbox for image zooming and slide previews.
- **Slick Carousel**: Banner and client logo sliders.
- **AOS (Animate on Scroll)**: Smooth viewport scroll animations.
- **Toastify JS**: Non-intrusive notifications.

---

## 📁 Project Architecture

```
platinumemirate.com/
├── .htaccess                     # Root Apache rewrite rules (clean URLs & virtual routes)
├── .user.ini                     # Upload & execution limits for root PHP
├── index.php                     # Homepage
├── company.php                   # About Us & Team page
├── service.php                   # Services catalog
├── portfolio.php                 # Project gallery index
├── project_view.php              # Dynamic single project showcase
├── blogs.php                     # Blog articles listing
├── blog_view.php                 # Dynamic single blog post page
├── contact.php                   # Contact form & location information
│
├── assets/                       # Public frontend assets
│   ├── contents/                 # Reusable layout partials (nav, footer, styles, scripts)
│   ├── css/                      # Public stylesheets
│   ├── favicon/                  # Browser favicons & app manifests
│   ├── function/                 # Frontend processors (contact handler & mailer)
│   ├── img/                      # Public images & dynamic upload folders (projects, blogs, etc.)
│   ├── includes/                 # Database connection config
│   └── js/                       # Public JavaScript (main.js)
│
└── admin/                        # Admin Content Management System
    ├── .htaccess                 # Admin PHP environment configurations
    ├── .user.ini                 # Upload limits (64MB) & execution timeout settings
    ├── composer.json             # Backend dependencies (Google API client, Guzzle)
    ├── index.php                 # Admin dashboard overview
    ├── login.php                 # Secure administrator login
    ├── analytics.php             # Google Analytics reporting dashboard
    ├── categories.php            # Category management (add, edit, list)
    ├── projects.php              # Project management (add, edit, list)
    ├── services.php              # Service offerings manager
    ├── blogs.php                 # Blog manager
    ├── testimonial.php           # Client testimonials manager
    ├── clients.php               # Client logo manager
    ├── team.php                  # Team members manager
    ├── contact.php               # Customer inquiry messages
    ├── settings.php              # Website configuration & SEO settings
    └── assets/
        ├── content/              # Admin layout components (sidebar navbar, modals)
        ├── css/                  # Admin styling
        ├── functions/            # Core backend logic (functions.php - CRUD & auth)
        ├── images/               # Admin system icons & logos
        ├── includes/             # Database connection & session verification (db.php)
        └── js/                   # Admin UI scripts
```

---

## 🚀 Getting Started & Local Setup

### Prerequisites
- **Web Server**: Apache 2.4+ (with `mod_rewrite` enabled) or LiteSpeed / Nginx.
- **PHP**: Version 7.4 or 8.x with extensions:
  - `mysqli`
  - `gd` (required for image compression & WebP processing)
  - `curl`
  - `json`
  - `mbstring`
  - `openssl`
- **Database**: MySQL 5.7+ or MariaDB 10.3+.
- **Composer**: For installing PHP dependencies.

---

### Installation Steps

1. **Clone the repository**:
   ```bash
   git clone <repository-url> platinumemirate.com
   cd platinumemirate.com
   ```

2. **Install Admin Dependencies**:
   ```bash
   cd admin
   composer install
   cd ..
   ```

3. **Configure File Permissions**:
   Ensure write permissions on upload directories so the CMS can store uploaded images:
   ```bash
   chmod -R 775 assets/img/
   ```

---

### Database Configuration

Update the MySQL credentials in both database configuration files:

1. **Frontend Connection** — [`assets/includes/db.php`](file:///assets/includes/db.php):
   ```php
   <?php
   $con = new mysqli("localhost", "DB_USERNAME", "DB_PASSWORD", "DB_NAME");
   if ($con->connect_error) {
       die("Connection failed: " . $con->connect_error);
   }
   ?>
   ```

2. **Admin CMS Connection** — [`admin/assets/includes/db.php`](file:///admin/assets/includes/db.php):
   ```php
   <?php
   session_start();
   $con = new mysqli("localhost", "DB_USERNAME", "DB_PASSWORD", "DB_NAME");
   if (!isset($_SESSION["habrix_admin_loggedin"])) {
       header("Location: login.php");
       exit();
   }
   ?>
   ```

---

### PHP Runtime Configuration

Because the portfolio and project managers support uploading high-resolution media galleries in batches, PHP must be configured with adequate upload and memory allowances.

Verify or add the following in your `php.ini`, `.user.ini`, or `.htaccess`:

```ini
upload_max_filesize = 64M
post_max_size = 64M
memory_limit = 256M
max_execution_time = 300
max_input_time = 300
```

> **Note**: Both the root directory and the `admin/` directory already contain tailored `.user.ini` and `.htaccess` directives for servers running PHP-FPM, LiteSpeed, or Apache `mod_php`.

---

## 🌐 URL Routing & Server Configuration

The root [`.htaccess`](file:///.htaccess) file configures SEO-friendly, clean URLs:

| Clean URL Pattern | Internal Destination | Description |
| :--- | :--- | :--- |
| `/company` | `company.php` | Automatically strips `.php` extensions |
| `/portfolio` | `portfolio.php` | Portfolio gallery overview |
| `/service` | `service.php` | Services page |
| `/contact` | `contact.php` | Contact Us & Enquiry page |
| `/blogs` | `blogs.php` | Blog index |
| `/blog/<slug>` | `blog_view.php?blog=<slug>` | Virtual route for blog posts |
| `/project/<slug>` | `project_view.php?project=<slug>` | Virtual route for project detail view |

---

## 🗄 Database Schema Overview

The application utilizes the following primary MySQL tables:

| Table | Description |
| :--- | :--- |
| `tbl_company` | Master settings: administrator credentials, company contact details, social links, SEO meta tags, and counter statistics. |
| `tbl_projects` | Projects table storing title, category ID, location, description, cover image, and URL keyword slug. |
| `tbl_project_img` | One-to-many project gallery images linked by `pid` foreign key. |
| `tbl_categories` | Categories used to organize portfolio projects. |
| `tbl_services` | Offerings showcased on the services page (icon, title, description). |
| `tbl_blogs` | Articles containing cover imagery, content, SEO slugs, and publication dates. |
| `tbl_testimonial` | Client reviews, avatar images, author names, and designations. |
| `tbl_clients` | Partner and client logos with ALT descriptions. |
| `tbl_team` | Team members, designations, and portraits. |
| `tbl_carousels` | Banner slider images and headlines for desktop and mobile displays. |
| `tbl_contact` | Customer inquiries submitted through the contact page form. |
| `tbl_product_enquiry` | Product-specific inquiry submissions. |
| `tbl_login_attempt` | Security log for tracking admin authentication attempts and lockout thresholds. |

---

## 🔒 Security & Rate Limiting

- **Admin Authentication**: Passwords in `tbl_company` are verified using `SHA-256` hashing.
- **Brute-Force Protection**: The login mechanism inspects `tbl_login_attempt`. If 5 failed attempts occur within 5 minutes, an automatic 5-minute lockout is enforced.
- **Session Protection**: All administrative endpoints verify `$_SESSION["habrix_admin_loggedin"]` via `admin/assets/includes/db.php` and redirect unauthenticated requests to `login.php`.
- **Anti-Spam Form Verification**: Frontend contact forms validate submissions with Google reCAPTCHA prior to executing database writes or sending emails.
- **Credential Segregation**: Sensitive credentials (such as Google Service Account keys and `.env` files) are excluded from version control via `.gitignore`.

---

## 🔌 Third-Party Integrations

1. **Google Analytics**:
   - Integrated into `admin/analytics.php`.
   - Requires Google Service Account JSON credentials placed in `admin/credentials.json` (configured via `GOOGLE_APPLICATION_CREDENTIALS`).
2. **PHPMailer (SMTP)**:
   - Configured in `assets/function/function.php` for relaying inquiry emails through secure SMTP.
3. **Google reCAPTCHA**:
   - Site and Secret keys configured for verifying human submissions on contact inquiries.

---

## ❓ Troubleshooting & FAQs

### Images fail to upload or return "Upload size exceeds server limit"
- Ensure `upload_max_filesize` and `post_max_size` in `.user.ini` / `php.ini` are at least `64M`.
- Verify the web server has write permissions to `assets/img/projects/` and its subdirectories.

### 404 Not Found on clean URLs like `/portfolio` or `/project/...`
- Ensure Apache's `mod_rewrite` is enabled:
  ```bash
  sudo a2enmod rewrite
  sudo systemctl restart apache2
  ```
- Ensure `AllowOverride All` is set for the document root in your virtual host configuration.

### Analytics dashboard shows authentication error
- Ensure your Google Analytics Service Account JSON key is placed at `admin/credentials.json` and has read permissions to your Google Analytics 4 Property ID.

---

## 📄 License & Attribution

Designed and developed for **Platinum Interiors LLC** & **Platoplus Design & Fitout LLC**.  
All rights reserved. Unauthorized duplication or redistribution of code and assets is strictly prohibited.
