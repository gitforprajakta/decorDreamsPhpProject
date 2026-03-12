<?php
require_once __DIR__ . '/includes/auth.php';

$page_title = 'Login';

if (is_admin_logged_in()) {
    header('Location: users.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($userid === '' || $password === '') {
        $error = 'Please enter both user ID and password.';
    } elseif (try_admin_login($userid, $password)) {
        header('Location: users.php');
        exit;
    } else {
        $error = 'Invalid credentials.';
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="section-block login-section">
  <h1 class="page-title">Administrator Login</h1>
  <p class="login-intro">Sign in to access the secure user list.</p>

  <?php if ($error): ?>
    <div class="login-error"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form class="login-form" method="post" action="login.php">
    <div class="form-group">
      <label for="userid">User ID</label>
      <input type="text" id="userid" name="userid" required autofocus>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>

    <button type="submit" class="cta">Sign In</button>
  </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

