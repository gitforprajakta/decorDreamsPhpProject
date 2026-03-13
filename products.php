<?php
$page_title = 'Products & Services';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/products_data.php';
?>

<h1 class="page-title">Products &amp; Services</h1>

<p class="section-block">We offer a wide range of home décor products and design services to help you create the space you've always wanted.</p>

<p class="recent-link-wrap"><a href="recent.php" class="recent-link">View your last 5 visited products &rarr;</a></p>

<section class="section-block">
  <h2>Our Products &amp; Services</h2>
  <div class="card-grid">
    <?php foreach ($PRODUCTS as $item): ?>
    <div class="card">
      <div class="card-image">
        <a href="product.php?id=<?php echo (int) $item['id']; ?>">
          <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
        </a>
      </div>
      <div class="card-body">
        <h3><a href="product.php?id=<?php echo (int) $item['id']; ?>"><?php echo htmlspecialchars($item['name']); ?></a></h3>
        <p><?php echo htmlspecialchars(mb_strimwidth($item['description'], 0, 120, '…')); ?></p>
        <p><a href="product.php?id=<?php echo (int) $item['id']; ?>" class="card-cta">View details</a></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
