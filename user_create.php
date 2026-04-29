<?php
require_once __DIR__ . '/includes/db.php';

$page_title = 'Create User';
$errors = [];
$success = false;
$form = [
    'first_name' => '',
    'last_name' => '',
    'email' => '',
    'home_address' => '',
    'home_phone' => '',
    'cell_phone' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($form as $field => $value) {
        $form[$field] = trim($_POST[$field] ?? '');
    }

    if ($form['first_name'] === '') $errors[] = 'First name is required.';
    if ($form['last_name'] === '') $errors[] = 'Last name is required.';
    if ($form['email'] === '') {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email must be a valid email address.';
    }
    if ($form['home_address'] === '') $errors[] = 'Home address is required.';
    if ($form['home_phone'] === '') $errors[] = 'Home phone is required.';
    if ($form['cell_phone'] === '') $errors[] = 'Cell phone is required.';

    if (empty($errors)) {
        try {
            create_company_user($form);
            $success = true;
            foreach ($form as $field => $value) {
                $form[$field] = '';
            }
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errors[] = 'A user with this email already exists.';
            } else {
                $errors[] = 'Database error: ' . $e->getMessage();
            }
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<h1 class="page-title">Create User</h1>

<p class="section-block"><a href="user.php" class="back-link">&larr; Back to User section</a></p>

<?php if ($success): ?>
  <div class="form-message success-message">User created successfully.</div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
  <div class="form-message error-message">
    <strong>Please fix the following:</strong>
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo htmlspecialchars($error); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<section class="section-block form-panel">
  <form class="user-form" method="post" action="user_create.php">
    <div class="form-row">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($form['first_name']); ?>" required>
      </div>

      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($form['last_name']); ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($form['email']); ?>" required>
    </div>

    <div class="form-group">
      <label for="home_address">Home Address</label>
      <textarea id="home_address" name="home_address" rows="3" required><?php echo htmlspecialchars($form['home_address']); ?></textarea>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="home_phone">Home Phone</label>
        <input type="tel" id="home_phone" name="home_phone" value="<?php echo htmlspecialchars($form['home_phone']); ?>" required>
      </div>

      <div class="form-group">
        <label for="cell_phone">Cell Phone</label>
        <input type="tel" id="cell_phone" name="cell_phone" value="<?php echo htmlspecialchars($form['cell_phone']); ?>" required>
      </div>
    </div>

    <button type="submit" class="cta form-submit">Create User</button>
  </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
