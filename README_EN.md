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
- Implements **routing** using `.htaccess` and a front controller (handling GET/POST routes).
- Features a **JavaScript countdown timer** for session expiration and automatic refresh.
- Uses a **modular, function-oriented structure** with a clear and maintainable directory layout.

---

## Directory structure

cosmetic_website_v2/
│── admin/ # Admin interface
│── assets/ # Images, styles (the project uses SASS (.scss) for style management)
│── config/ # Database configuration and helper functions
│── constans/ # File path constants
│── controllers/ # Request handling
│── includes/ # Header, footer, navigation
│── login_system/ # Login, authentication, and logout
│── pages/ # Additional pages (treatments, cookies, price list, booking)
│── scripts/ # Dynamic scripts (jQuery)
│── cosmetic_website_v2.sql # Database file
│── index.php # Homepage
│── logo.ico # Website icon
│── README.md # Documentation

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

Copy the `cosmetic_website_v2` folder to the `C:\xampp\htdocs\` directory.
The final path is: `C:\xampp\htdocs\cosmetic_website_v2\`

---

## Setting up the database

1. Open **XAMPP Control Panel**
2. Start **Apache** and **MySQL**.
3. Open [phpMyAdmin](http://localhost/phpmyadmin/) in your browser.
4. Create a new database called cosmetic_website_v2.
5. Import the included **`cosmetic_website_v2.sql`** file into the database.

---

## Accessing Websites

- [Homepage:](http://localhost/cosmetic_website_v2/)
- [Admin Login:](http://localhost/cosmetic_website_v2/login_system/login.php)

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