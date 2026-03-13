<?php
require_once __DIR__ . '/includes/products_data.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = get_product($id);

if (!$product) {
    header('Location: products.php');
    exit;
}

// Track this product in "last 5 visited" cookie
update_recent_products_cookie($id);

$page_title = $product['name'];
require_once __DIR__ . '/includes/header.php';
?>

<article class="product-detail">
  <div class="product-detail-grid">
    <div class="product-detail-image">
      <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
    </div>
    <div class="product-detail-body">
      <h1 class="page-title"><?php echo htmlspecialchars($product['name']); ?></h1>
      <p class="product-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
      <p><a href="products.php" class="back-link">&larr; Back to Products &amp; Services</a></p>
    </div>
  </div>
</article>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
