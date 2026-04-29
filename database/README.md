# Decor Dreams MySQL Setup

This folder contains the MySQL database setup for the User section.

## Bluehost Import

On Bluehost, create the database first in cPanel:

1. Open **MySQL Databases**.
2. Create a database, for example `yourcpaneluser_decor_dreams`.
3. Create a database user and password.
4. Add the user to the database with **All Privileges**.
5. Open **phpMyAdmin**, select that database, then import `database/decor_dreams.sql`.

Do not run `CREATE DATABASE` in Bluehost phpMyAdmin. Bluehost shared hosting blocks that command, so this SQL file only creates the `users` table and seed records inside the database you already selected.

## Local Import

From the project root, run:

```bash
mysql -u root -p < database/decor_dreams.sql
```

If your local MySQL root user has no password, run:

```bash
mysql -u root < database/decor_dreams.sql
```

The script creates:

- Table: `users`
- Seed data: 20 Decor Dreams users

## PHP Connection Settings

The site connects using `includes/db.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'decor_dreams');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
```

Update `DB_USER` and `DB_PASSWORD` if your local MySQL account is different.
