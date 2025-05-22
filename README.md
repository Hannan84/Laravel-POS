## Laravel POS

A simple POS management system with invoice generation, built with **Laravel 10** and **MySQL**.

## Features

-   **POS**
-   **Order & Stock Management**
-   **Product Management**
-   **Employee & Customer & Supplier Management**
-   **Salary Management**
-   **Attendance Management**
-   **Role & Permission System**
-   **User Management**

## How to Use

#### Clone the Repository

To get started, clone or download the repository:

```bash
git clone
```

#### Set Up the Project

Once you’ve cloned the repository, navigate to the project directory and install dependencies:

```bash
cd laravel-point-of-sale
composer install
```

#### Configure the Environment

Rename the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

#### Set Up the Database

Configure your database credentials in the `.env` file.

#### Seed the Database

Run the following command to migrate and seed the database:

```bash
php artisan migrate:fresh --seed
```

**Note**: If you encounter any errors, try rerunning the command.

#### Create Storage Link

Create a symbolic link for storage:

```bash
php artisan storage:link
```

#### Start the Server

To run the application locally, start the Laravel development server:

```bash
php artisan serve
```

#### Log In

Use the following credentials to log in:

-   **Username**: `admin`
-   **Password**: `password`
