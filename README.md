# 👥 Employee Management App

A web application to manage employees and departments, built with **Laravel** and **MySQL**.

> 🚧 **Status: in development.** Core modules are working, more features are coming.

## ✨ Features

- 🏢 Departments management (create, list, edit, delete)
- 👤 Employees management (create, list, edit, delete), linked to departments
- ✅ Success messages and validation on every action

## 🚧 Roadmap

- [ ] Projects management
- [ ] Assign employees to projects
- [ ] Authentication
- [ ] Modern UI redesign
- [ ] Search and filters

## 🛠️ Tech Stack

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

## ⚙️ Installation

1. Clone the repository
```bash
   git clone https://github.com/nesrinelahbecha/employee-management-laravel.git
   cd employee-management-laravel
```
2. Install dependencies
```bash
   composer install
```
3. Create your environment file and generate the app key
```bash
   copy .env.example .env
   php artisan key:generate
```
4. Create a MySQL database, then set your credentials in `.env`
5. Run the migrations
```bash
   php artisan migrate
```
6. Start the server
```bash
   php artisan serve
```

## 👩‍💻 Author

**Nesrine Lahbecha**, Full-Stack Web & Mobile Developer

💼 [LinkedIn](https://www.linkedin.com/in/nesrinelahbecha)
