<?php
$page_title = 'Home';
require_once __DIR__ . '/includes/header.php';
?>

<section class="hero" style="background-image: linear-gradient(135deg, rgba(232,226,217,0.92) 0%, rgba(250,248,245,0.88) 50%, rgba(255,255,255,0.9) 100%), url('images/hero.jpg');">
  <h1>Welcome to Decor Dreams</h1>
  <p class="tagline">Where Style Meets Comfort</p>
  <p>Transform your space with curated furniture, accents, and design services.</p>
  <a href="products.php" class="cta">Explore Our Collection</a>
</section>

<section class="section-block">
  <h2>Why Decor Dreams?</h2>
  <p>We bring together quality home furnishings, unique décor pieces, and personalized design support so you can create a home you love. From modern minimal to cozy traditional, find pieces that tell your story.</p>
</section>

<section class="section-block">
  <h2>Featured Categories</h2>
  <div class="card-grid">
    <div class="card">
      <div class="card-image"><img src="images/living-room.jpg" alt="Luxury living room furniture"></div>
      <div class="card-body">
        <h3>Furniture</h3>
        <p>Sofas, tables, and seating for every room.</p>
      </div>
    </div>
    <div class="card">
      <div class="card-image"><img src="images/accents-decor.jpg" alt="Home accents and décor"></div>
      <div class="card-body">
        <h3>Accents & Décor</h3>
        <p>Lighting, rugs, art, and accessories.</p>
      </div>
    </div>
    <div class="card">
      <div class="card-image"><img src="images/design-service.jpg" alt="Interior design service"></div>
      <div class="card-body">
        <h3>Design Services</h3>
        <p>Consultation and styling for your space.</p>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
