#  Hostel Management System (HMS)

A robust, web-based management solution built with Laravel to streamline hostel administration, student records, and facility management.

---

##  Tech Stack
* **Backend:** PHP (Laravel 10+)
* **Frontend:** Blade Templates, Bootstrap/TailwindCSS
* **Database:** MySQL / MariaDB
* **Auth:** Laravel Breeze / Jetstream
* **Server:** Apache (XAMPP/WAMP)

---

##  Key Features

###  User Management
* **Role-Based Access:** Dedicated dashboards for Admin, Staff, and Students.
* **Student Lifecycle:** Registration, profile management, and room allocation.

###  Room & Facility Control
* **Inventory Tracking:** Real-time room availability and assignment.
* **Maintenance:** Integrated complaints management system for students.

###  Finance & Communication
* **Fee Management:** Tracking collection and payment history.
* **Notice Board:** Automated announcements and notices module.

---

##  Installation Guide

Follow these steps to set up the project locally:

### 1. Clone the Repository
```bash
git clone [https://github.com/TAYYABAA-BATOOL/hostel-management-system.git](https://github.com/TAYYABAA-BATOOL/hostel-management-system.git)
cd hostel-management-system

```

### 2. Dependency Setup

```bash
composer install
npm install && npm run dev

```

### 3. Configuration

* Copy `.env.example` to `.env`.
* Configure your database settings in `.env`.
* Generate app key:

```bash
php artisan key:generate

```

### 4. Database Migration

```bash
php artisan migrate --seed

```

### 5. Start Server

```bash
php artisan serve

```

---

**Developed by Tayyaba** | *Full-Stack Web Developer*

