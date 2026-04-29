<?php
$page_title = 'User';
require_once __DIR__ . '/includes/header.php';
?>

<h1 class="page-title">User Section</h1>

<p class="section-block">Create new Decor Dreams customer records or search existing users by name, email, home phone, or cell phone.</p>

<section class="section-block">
  <div class="card-grid user-action-grid">
    <div class="card">
      <div class="card-body">
        <h2>Create User</h2>
        <p>Add a new customer record with contact and address details.</p>
        <p><a href="user_create.php" class="card-cta">Open creation form &rarr;</a></p>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h2>Search Users</h2>
        <p>Find users by first name, last name, email address, home phone, or cell phone.</p>
        <p><a href="user_search.php" class="card-cta">Open search form &rarr;</a></p>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
