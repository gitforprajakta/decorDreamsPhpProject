<?php
$page_title = 'Last 5 Visited Products';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/products_data.php';

$recent_ids = get_recent_product_ids_from_cookie();
$recent_products = [];
foreach ($recent_ids as $rid) {
    $p = get_product($rid);
    if ($p) $recent_products[] = $p;
}
?>

<h1 class="page-title">Last 5 Visited Products</h1>

<?php if (empty($recent_products)): ?>
<p class="section-block no-recent">You haven't viewed any products yet. <a href="products.php">Browse our products &amp; services</a> and your last five visited items will appear here.</p>
<?php else: ?>
<p class="section-block">Here are the last five products or services you viewed (most recent first).</p>
<div class="card-grid">
  <?php foreach ($recent_products as $item): ?>
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
<?php endif; ?>

<p class="back-to-products"><a href="products.php">&larr; Back to Products &amp; Services</a></p>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
