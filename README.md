# DigiReads

## Introduction

DigiReads is a web application built with Laravel. Follow these instructions to set up and run the DigiReads project on your local machine.

## Installation

Make sure you have Laravel 11 installed

### Step 1: Clone the Repository

```bash
git clone https://github.com/Valencza/perpustakaan-digital.git
cd perpustakaan-digital
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Set Up Environment File

```bash
php -r "file_exists('.env') || copy('.env.example', '.env');"
```

### Step 4: Configure the Database

Open the `.env` file and update the database connection settings:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

### Step 5: Generate Application Key

```bash
php artisan key:generate
```

### Step 6: Run Database Migrations

```bash
php artisan migrate
```

### Step 7: Seed the Database

```bash
php artisan db:seed
```

### Step 8: Link data from storage

```bash
php artisan storage:link
```

### Step 9: Start the Development Server

```bash
php artisan serve
```

Your DigiReads application should now be up and running. You can access it at `http://127.0.0.1:8000`.

<!-- ### Step 10: Tes Login

```bash
Email: admin@example.com
Password: 12345678
```

### Noted: 

```bash
The TinyMCE API Key can be changed using an account from your own device

Open Folder:
- resources
    - Templates
        - admin.blade.php

then change the part code

<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>
```

## License
```This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.``` -->


