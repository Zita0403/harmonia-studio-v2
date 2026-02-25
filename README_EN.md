<p align="right">
  🌐 <a href="README.md">Magyar verzió</a>
</p>

# Harmony Studio – Administration System

**Language:** [HU Magyar](README.md) | GB English

![Harmony Studio Admin Page Screenshot](assets/images/cosmetic_website_v2.png)

This project presents the **admin interface of the fictional beauty salon "Harmony Studio**, developed as a continuation of my **demonstration website** created at the end of the first module of the **Full Stack Web Development Training** (HTML+CSS(+JavaScript basics) Front-End Development course) and as **the final project of the second module** (PHP Programming + MySQL Database Training).

---

## Description

The purpose of this project is to create a **modern, maintainable, and secure administration system** that:
- **Stores** services, homepage sections, treatment categories, and admin users in a database.
- Provides an **admin interface** to **add, edit, and delete data (CRUD)** operations.
- Includes **user authentication** with password hashing (`password_hash` / `password_verify`) and **session expiration handling**.
- Features a **JavaScript countdown timer** for session expiration and automatic refresh.
- Uses a **modular, function-oriented structure** with a clear and maintainable directory layout.
- **Clean URL & Routing:** Implemented with .htaccess and Front Controller pattern to ensure clean and user-friendly paths (e.g., /login, /admin).
- **Responsive Design:** A Mobile-First interface built with SASS for optimal viewing across all devices.

---

## Directory structure

```text
cosmetic_website_v2/ 
│   README.md
│   README_EN.md
│
├───app/                                 # Backend logic (private/non-public)
│   │   .env                             # Sensitive data (NOT included in the repo)
│   │   .env.local
│   │   cosmetic_website_v2.sql          # Database export
│   │
│   ├───admin/                           # Admin Dashboard: Central interface for content management (CRUD UI)
│   │
│   ├───config/                          # Database helpers, DB connection, SQL queries, and security filters
│   │
│   ├───constans/                        # Global file paths and constants
│   │
│   ├───controllers/                     # Central request handler, validation, and CRUD logic
│   │
│   ├───includes/                        # Reusable modules (header, footer, nav)                  
│   │
│   └───login_system/                    # Authentication and logout management
│
└───public/                              # Public web directory (Document Root)
    │   .htaccess                        # URL rewrite rules for index.php redirection
    │   index.php                        # Entry point (Front Controller): URL routing, session & dependency management
    │   logo.ico                         # Site icon (favicon)
    │   
    ├───assets/                          # Static assets
    │   ├───images/                      # Site images and uploaded content
    │   │
    │   ├───scripts/
    │   │       scripts.js               # Client-side logic: interactions, validations, and UI animations
    │   │
    │   └───styles/ # Stílusok kezelése  # Stylesheet management
    │           _*.scss                  # SASS partials (variables, mixins, resets)
    │           *.scss                   # Page-specific SASS source files
    │           *.css                    # Compiled, browser-ready stylesheets
    │
    └───pages/                           # Dynamically loaded subpages
            404.php
            body-treatment.php
            booking.php
            cookie-policy.php
            facial-treatment.php
            hair-removal.php
            home.php
            make-up.php
            price-list.php
```

---

## Database

### Tables:
1. login_data - admin users (email, password hash, last check)
2. home_page_section - home page sections (title, content)
3. highlighted_treatment - highlighted treatments
4. treatment_categories - treatment categories
5. argument - other content of the home page

Relationships: highlighted treatments and categories are linked with a one-to-many relationships within the homepage structure.

---

## Information for downloading and opening

1. Copying: Place the cosmetic_website_v2 folder into your C:\xampp\htdocs\ directory.

2. Virtual Host Configuration (Recommended):
To ensure the application runs correctly and securely, add the following configuration to your C:\xampp\apache\conf\extra\httpd-vhosts.conf file:

```text
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/cosmetic_website_v2/public"
    ServerName localhost
</VirtualHost>
```
3. Database: Import the cosmetic_website_v2.sql file using phpMyAdmin.

4. Environment Variables: Set up your database credentials in the app/.env.local file.

---

## Setting up the database

1. Open **XAMPP Control Panel**
2. Start **Apache** and **MySQL**.
3. Open [phpMyAdmin](http://localhost/phpmyadmin/) in your browser.
4. Create a new database called cosmetic_website_v2.
5. Import the included **`cosmetic_website_v2.sql`** file into the database.

---

## Accessing Websites

Live Demo
The project is available live at the following link: harmoniastudio.zita.dev

Local Environment
Once the Virtual Host is configured, you can access the site locally:

- [Client Homepage:](http://localhost/)
- [Admin Login:](http://localhost/login)

---

## Login Data:

- **Username**: admin@example.com
- **Password**: Admin!123

---

## Technologies Used

- **PHP 8.x** - backend logic, session management, function-oriented approach
- **MySQL/MariaDB** - database for storage
- **JavaScript** - session countdown, interactive functions
- **HTML5 / CSS3 / SASS** - responsive, semantically correct frontend
- **Font Awesome + Google Fonts** - icons and typography

---

## System Requirements

PHP Version: PHP 8.2.12
Web Server: Apache (XAMPP 8.2.12)
Database: MariaDB/MySQL

---

## Created by
Name: Zita Lukács
Date: February 2025
Module: PHP programming + MySQL database