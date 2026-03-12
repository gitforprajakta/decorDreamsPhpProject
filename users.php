<?php
require_once __DIR__ . '/includes/auth.php';
require_admin_login();

$page_title = 'Secure Users';
require_once __DIR__ . '/includes/header.php';

$users_doc = @file_get_contents(__DIR__ . '/data/site_users.txt');
if ($users_doc === false) $users_doc = "User list not found.\n";
?>

<section class="section-block secure-section">
  <h1 class="page-title">Current Users</h1>
  <p class="secure-intro">This section is restricted to the administrator.</p>
  <p><a href="logout.php" class="logout-link">Logout</a></p>
  <div class="users-document">
    <pre><?php echo htmlspecialchars($users_doc); ?></pre>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

