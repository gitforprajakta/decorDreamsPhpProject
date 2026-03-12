<?php
$page_title = 'Contacts';
require_once __DIR__ . '/includes/config.php';
$contacts = load_contacts();
require_once __DIR__ . '/includes/header.php';
?>

<h1 class="page-title">Contact Us</h1>

<p class="section-block">Reach out to us for orders, support, or design inquiries. Our contact information is loaded from our company records below.</p>

<div class="contacts-sections">
  <?php foreach ($contacts as $section): ?>
  <div class="contact-section">
    <h3><?php echo htmlspecialchars($section['title']); ?></h3>
    <ul>
      <?php foreach ($section['lines'] as $line):
        $line = trim($line);
        if ($line === '') continue;
        // Detect email and URL for linking
        if (preg_match('/^([^:]+):\s*(.+)$/', $line, $m)) {
          $label = trim($m[1]);
          $value = trim($m[2]);
          if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $display = '<a href="mailto:' . htmlspecialchars($value) . '">' . htmlspecialchars($value) . '</a>';
          } elseif (preg_match('#^https?://#', $value) || preg_match('#^www\.#', $value)) {
            $url = preg_match('#^https?://#', $value) ? $value : 'https://' . $value;
            $display = '<a href="' . htmlspecialchars($url) . '" target="_blank" rel="noopener">' . htmlspecialchars($value) . '</a>';
          } elseif (preg_match('/^[\d\s\-\(\)\+]+$/', $value)) {
            $display = '<a href="tel:' . preg_replace('/\s+/', '', $value) . '">' . htmlspecialchars($value) . '</a>';
          } else {
            $display = htmlspecialchars($value);
          }
          echo '<li><strong>' . htmlspecialchars($label) . ':</strong> ' . $display . '</li>';
        } else {
          echo '<li>' . htmlspecialchars($line) . '</li>';
        }
      endforeach; ?>
    </ul>
  </div>
  <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
