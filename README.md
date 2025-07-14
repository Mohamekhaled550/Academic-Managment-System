# 🎓 Academic Management System

A comprehensive Laravel-based web application for managing student registration, academic progress, and GPA calculation based on the credit-hour system. Designed for faculties with multiple departments, grading scales, and semester-based course registration.

## 🚀 Features

- Student login using national ID.
- Smart course registration based on:
  - GPA
  - Passed credit hours
  - Prerequisites
  - Term and level availability
- Automatic calculation of:
  - GPA and GPA points
  - Letter grades
  - Total passed credit hours
  - Academic level (Level 1 → 4)
- Two-term registration allowed for new students (without GPA restriction).
- Multi-department support: General Sciences, Computer Science, Information Systems.
- Admin-controlled term management.
- CSV export/import using Laravel Excel.
- Modern responsive UI with RTL support for Arabic users.
- Grade updates trigger automatic GPA & level recalculations via Observers & Services.

## ⚙️ Built With

- Laravel 8
- Laravel Spatie (Roles & Permissions)
- Laravel Excel (maatwebsite/excel)
- Bootstrap 5
- MySQL
- PHP 8+

## 📸 Screenshots

> You can add screenshots in this section like this:

| Student Dashboard | Course Registration |
|-------------------|---------------------|
| ![Dashboard](screenshots/dashboard.jpg) | ![Register](screenshots/registration.jpg) || ![studentdashboard](screenshots/studentdashboard.jpg) |

Add screenshots under a `/screenshots` folder in your repository.

## 🛠️ Installation & Setup

```bash
git clone https://github.com/Mohamekhaled550/Academic-Managment-System.git
cd Academic-Managment-System

composer install
cp .env.example .env
php artisan key:generate

# Configure your .env DB settings here

php artisan migrate --seed

php artisan serve

 Available Artisan Commands
bash
Copy
Edit
php artisan migrate --seed       # Run migrations and seeders
php artisan db:seed              # Seed only
php artisan serve                # Start local server


Seeded Data Includes
Departments

Courses (realistic full plan for 8 academic terms)

Grading scale (letter grades and GPA points)

Terms (with registration periods)

Course prerequisites

A test student account (with national ID login)


👤 About the Developer
Mohamed Khaled Abdelghaffar Salem
Bachelor's Degree in Information Systems
Faculty of Computers & Artificial Intelligence, Fayoum University

🔗 LinkedIn Profile

🐙 GitHub Profile




