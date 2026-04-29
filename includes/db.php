<?php
/**
 * Decor Dreams - MySQL connection and user table helpers
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'cxbcfkmy_decor_dreams');
define('DB_USER', 'cxbcfkmy_adminDecorDreams');
define('DB_PASSWORD', 'Praesh@1404');

function get_db_connection() {
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}

function create_company_user($user) {
    $sql = 'INSERT INTO users (first_name, last_name, email, home_address, home_phone, cell_phone)
            VALUES (:first_name, :last_name, :email, :home_address, :home_phone, :cell_phone)';

    $stmt = get_db_connection()->prepare($sql);
    $stmt->execute([
        ':first_name' => $user['first_name'],
        ':last_name' => $user['last_name'],
        ':email' => $user['email'],
        ':home_address' => $user['home_address'],
        ':home_phone' => $user['home_phone'],
        ':cell_phone' => $user['cell_phone'],
    ]);
}

function search_company_users($query) {
    $query = trim($query);

    if ($query === '') {
        return [];
    }

    $like = '%' . $query . '%';
    $sql = 'SELECT id, first_name, last_name, email, home_address, home_phone, cell_phone, created_at
            FROM users
            WHERE first_name LIKE :first_name
               OR last_name LIKE :last_name
               OR CONCAT(first_name, " ", last_name) LIKE :full_name
               OR email LIKE :email
               OR home_phone LIKE :home_phone
               OR cell_phone LIKE :cell_phone
            ORDER BY last_name, first_name';

    $stmt = get_db_connection()->prepare($sql);
    $stmt->execute([
        ':first_name' => $like,
        ':last_name' => $like,
        ':full_name' => $like,
        ':email' => $like,
        ':home_phone' => $like,
        ':cell_phone' => $like,
    ]);

    return $stmt->fetchAll();
}
