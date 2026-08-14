# Platform E-Commerce

<div align="center">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Version">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
  <img src="https://img.shields.io/badge/Build-Passing-brightgreen?style=for-the-badge" alt="Build Status">
</div>

---

## About This Project

**Leet E-Commerce** is a robust, full-stack online store platform built with Laravel 11. It provides a seamless shopping experience for customers and a comprehensive management dashboard for administrators. 

What sets this project apart is its **manual payment verification system**—allowing customers to upload proof of payment (receipts/transfer slips) which admins can review and approve directly from the dashboard. Additionally, it features **advanced inventory management** that tracks stock levels specifically by clothing size variants (S, M, L, XL, 2XL), making it highly suitable for fashion and apparel retailers.

---

## Key Features

### Customer Experience
- **Dynamic Product Catalog:** Browse products with detailed views, including multiple images, descriptions, and size-specific stock availability.
- **Intuitive Shopping Cart:** Add products to the cart with specific size variants and quantities.
- **Manual Payment Checkout:** Secure checkout process supporting manual bank transfers with proof of payment image uploads.
- **Order Tracking:** User profile dashboard to monitor order statuses (Pending, Processing, Completed) and view transaction history.

### Administrator Panel
- **Comprehensive Dashboard:** Modern, responsive admin interface for complete store oversight.
- **Advanced Product Management (CRUD):**
  - Add/Edit/Delete products with multi-image support (up to 4 images per product).
  - Manage stock quantities individually for each size variant (S, M, L, XL, 2XL).
- **Transaction & Order Processing:**
  - Review incoming orders and verify uploaded payment receipts via interactive modals.
  - Approve or reject transactions in real-time.
  - Automatically update stock levels upon successful transaction approval.
  - Calculate dynamic shipping costs based on regional addresses (e.g., Jakarta, Bandung, West Java).

---

## Tech Stack

- **Backend:** PHP 8.2, Laravel 11.9
- **Frontend:** Blade Templating, Tailwind CSS, Bootstrap 5 (UI Components)
- **Database:** MySQL / MariaDB
- **Asset Management:** Vite

---

## Prerequisites

Before installing the project, ensure you have the following software installed on your system:
- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x & **npm**
- **MySQL** or **MariaDB**
- **Git**

---

## 💻 Installation & Setup Guide

Follow these step-by-step instructions to get the project running on your local machine from scratch.

### 1. Clone the Repository
```bash
git clone https://github.com/arpojan/Leet-Ecommerce.git
cd Leet-Ecommerce
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies & Build Assets
```bash
npm install
npm run build
```

### 4. Environment Configuration
Copy the example environment file and generate a unique application key.
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Database Setup
Create a new MySQL database (e.g., `leet_ecommerce`). Then, update your `.env` file with the database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leet_ecommerce
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Run Migrations & Seeders
This command will create the necessary database tables and populate them with default products and admin accounts.
```bash
php artisan migrate:fresh --seed
```

### 7. Create Storage Link
Link the storage directory to the public folder so that product images and uploaded payment receipts are publicly accessible.
```bash
php artisan storage:link
```

### 8. Start the Development Server
```bash
php artisan serve
```
Your application will now be live at: `http://127.0.0.1:8000`

---

## 👥 Default Credentials

After running the database seeders, you can access the application using the following default accounts:

| Role | Email | Password | Access Level |
|------|-------|----------|--------------|
| **Admin** | `admin@example.com` | `password` | Full access to Admin Panel |
| **Customer** | `test@example.com` | `password` | Regular shopping access |

---

## 🔌 Core Routes & Endpoints

While this is primarily a monolithic web application, here are the core routes handling the business logic:

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/` | Storefront Home & Product Catalog | ❌ |
| `GET` | `/user/home/{id}/keranjang` | View user's shopping cart | ✅ (Customer) |
| `POST` | `/checkout` | Process cart items for checkout | ✅ (Customer) |
| `POST` | `/user/home/{id}/pembayaran-proses` | Upload payment receipt | ✅ (Customer) |
| `GET` | `/admin` | Admin Dashboard Overview | ✅ (Admin) |
| `POST` | `/admin/transaksi/transaksi-sukses/{id}` | Approve order & deduct stock | ✅ (Admin) |

---

## Screenshots

> **Note to Developer:** Please replace the placeholders below with actual image paths once screenshots are captured.

| Storefront Catalog | Product Details | Admin Dashboard | Order Verification |
|:---:|:---:|:---:|:---:|
| ![Catalog]([CATALOG_IMAGE_URL]) | ![Product]([PRODUCT_IMAGE_URL]) | ![Dashboard]([ADMIN_DASHBOARD_URL]) | ![Verification]([ORDER_VERIFICATION_URL]) |

---

## Contributing

Contributions are welcome! If you'd like to improve Leet E-Commerce:
1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---
</div>
