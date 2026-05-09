<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');
if ($current_page === 'index') $current_page = 'home';
if (in_array($current_page, ['product', 'recent', 'top_products'], true)) $current_page = 'products';
if (in_array($current_page, ['user_create', 'user_search'], true)) $current_page = 'user';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/marketplace_partner_visit.php';
marketplace_partner_report_visit_to_hub();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' | ' : ''; ?>Decor Dreams</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <?php if (isset($canonical)): ?>
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
  <?php endif; ?>
</head>
<body>
  <header class="site-header">
    <div class="header-inner">
      <a href="index.php" class="logo">Decor <span>Dreams</span></a>
      <nav class="main-nav">
        <a href="index.php" class="<?php echo $current_page === 'home' ? 'active' : ''; ?>">Home</a>
        <a href="about.php" class="<?php echo $current_page === 'about' ? 'active' : ''; ?>">About</a>
        <a href="products.php" class="<?php echo $current_page === 'products' ? 'active' : ''; ?>">Products &amp; Services</a>
        <a href="user.php" class="<?php echo $current_page === 'user' ? 'active' : ''; ?>">User</a>
        <a href="news.php" class="<?php echo $current_page === 'news' ? 'active' : ''; ?>">News</a>
        <a href="contacts.php" class="<?php echo $current_page === 'contacts' ? 'active' : ''; ?>">Contacts</a>
        <?php if (is_admin_logged_in()): ?>
          <a href="users.php" class="<?php echo $current_page === 'users' ? 'active' : ''; ?>">Secure</a>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.php" class="<?php echo $current_page === 'login' ? 'active' : ''; ?>">Login</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
  <main class="main-content">
