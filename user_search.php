<?php
require_once __DIR__ . '/includes/db.php';

$page_title = 'Search Users';
$query = trim($_GET['q'] ?? '');
$users = [];
$error = '';
$searched = $query !== '';

if ($searched) {
    try {
        $users = search_company_users($query);
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<h1 class="page-title">Search Users</h1>

<p class="section-block"><a href="user.php" class="back-link">&larr; Back to User section</a></p>

<section class="section-block form-panel">
  <form class="user-form search-form" method="get" action="user_search.php">
    <div class="form-group">
      <label for="q">Search by name, email, home phone, or cell phone</label>
      <input type="search" id="q" name="q" value="<?php echo htmlspecialchars($query); ?>" placeholder="Example: Patel, maya@example.com, or 555-0101" required>
    </div>
    <button type="submit" class="cta form-submit">Search</button>
  </form>
</section>

<?php if ($error): ?>
  <div class="form-message error-message"><?php echo htmlspecialchars($error); ?></div>
<?php elseif ($searched): ?>
  <section class="section-block">
    <h2>Search Results</h2>
    <?php if (empty($users)): ?>
      <p>No users matched "<?php echo htmlspecialchars($query); ?>".</p>
    <?php else: ?>
      <div class="table-wrap">
        <table class="users-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Home Address</th>
              <th>Home Phone</th>
              <th>Cell Phone</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                <td><a href="mailto:<?php echo htmlspecialchars($user['email']); ?>"><?php echo htmlspecialchars($user['email']); ?></a></td>
                <td><?php echo htmlspecialchars($user['home_address']); ?></td>
                <td><a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $user['home_phone']); ?>"><?php echo htmlspecialchars($user['home_phone']); ?></a></td>
                <td><a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $user['cell_phone']); ?>"><?php echo htmlspecialchars($user['cell_phone']); ?></a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
