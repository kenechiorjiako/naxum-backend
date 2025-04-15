# Naxum Backend Project (Update Title As Needed)

A Laravel application providing an administrative dashboard and a user-facing API for account and contact management.

## Technology Stack

-   PHP 8.2+
-   Laravel 12
-   MySQL
-   Composer
-   Node.js / NPM
-   Vite
-   Tailwind CSS
-   Bootstrap

## Prerequisites

-   PHP >= 8.2
-   Composer installed globally
-   Node.js and NPM installed
-   A MySQL database server

## Setup Instructions

**Note:** This project includes a pre-configured `.env` file. You may need to adjust the MySQL database credentials (`DB_*` variables) if your local setup differs.

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/kenechiorjiako/naxum-backend.git
    cd naxum-backend
    ```

2.  **Install PHP Dependencies:**

    ```bash
    composer install
    ```

3.  **Database Setup:** This involves ensuring the MySQL server is running, the necessary database exists, and then importing the project data.

    **a. Check MySQL Server Status:**
    First, ensure your MySQL server is active. How you check this depends on your installation method:

    -   **Homebrew (macOS):** Run `brew services list` in your terminal. Look for `mysql` in the list and confirm its status is "started".
    -   **Systemd (Linux):** Run `systemctl status mysql`. Check the output to see if the service is active (running).
    -   **Docker:** Run `docker ps`. Look for your MySQL container in the list.
    -   **MAMP/XAMPP/WAMP:** Open the application's control panel and verify that the "MySQL Server" status indicator shows it is running.
        If the server is not running, use the appropriate command/interface to start it (e.g., `brew services start mysql`, `systemctl start mysql`, clicking the start button in MAMP/XAMPP).

    **b. Connect to MySQL & Check/Create Database:**
    Next, you need to verify the database specified in the `.env` file exists.

    1.  Connect to your MySQL server using your preferred method (command line or a GUI tool like TablePlus, DBeaver, phpMyAdmin). You'll typically need the username and password for a MySQL user (like `root` or another user you have configured).
        -   _Command Line Example:_ `mysql -u root -p` (It will prompt for the password) (password should be empty)
    2.  Once connected, list all existing databases:
        ```sql
        SHOW DATABASES;
        ```
    3.  Look for the database name specified in the `DB_DATABASE` variable in your `.env` file (e.g., `naxum_db`).
    4.  If the database **does not** exist in the list, create it:
        ```sql
        CREATE DATABASE naxum_db; -- Replace naxum_db if your .env uses a different name
        ```
    5.  Disconnect from the MySQL server (e.g., type `exit` in the command line client).

    **c. Import Database Backup:**
    Now, import the provided data into the database you just confirmed exists.

    1.  Make sure you are in the project's root directory (`naxum-backend`) in your terminal.
    2.  Run the following command, replacing `your_db_username` and `your_db_name` with the actual `DB_USERNAME` and `DB_DATABASE` values from your `.env` file. You will be prompted for the password for `your_db_username`.
        ```bash
        # Example: mysql -u root -p naxum_db < naxum_db_backup.sql
        mysql -u your_db_username -p your_db_name < naxum_db_backup.sql
        ```

    **d. (Alternative/If backup import fails):**
    If the import command fails for any reason, you might be able to set up the database schema using Laravel's migrations. This usually won't include the specific data from the backup.

    ```bash
    # php artisan migrate --seed # Uncomment and run only if the backup import failed
    ```

4.  **Install Node.js Dependencies:**
    ```bash
    npm install
    ```

## Running the Application

This project includes a convenient composer script to start all necessary development services concurrently:

```bash
composer run dev
```

This command will:

-   Start the PHP development server (usually on `http://localhost:8000` or the port specified by `APP_URL`).
-   Start the queue worker.
-   Start the Laravel Pail log viewer.
-   Start the Vite development server for frontend assets.

You can then access the application in your browser at the `APP_URL` defined in your `.env` file.

## Features

### Admin Panel (Web Routes)

Accessed via web browser, protected by session authentication.

-   **Login:** `GET /login`, `POST /login`
-   **Logout:** `POST /logout`
-   **Dashboard:** `GET /dashboard` (Requires Login)
-   **List Accounts:** `GET /accounts` (Requires Login)
-   **Create Account Form:** `GET /accounts/create` (Requires Login)
-   **Store New Account:** `POST /accounts` (Requires Login)

### User API (API Routes)

Accessed via API clients (e.g., Postman, frontend application). Most endpoints protected by Sanctum token authentication.

-   **Register:** `POST /api/register`
-   **Login:** `POST /api/login` (Returns Sanctum token)
-   **Update Contact:** `PUT /api/update-contact` (Requires Auth Token)
-   **Search Contacts:** `GET /api/search-contacts` (Requires Auth Token)
-   **List Accounts:** `GET /api/accounts` (Requires Auth Token)
