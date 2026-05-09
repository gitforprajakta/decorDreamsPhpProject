<?php
declare(strict_types=1);

/**
 * Marketplace feed — Decor Dreams (company_id 4).
 * Default: top 5 by server counts. ?catalog=all returns every product in the site catalog.
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$COMPANY_ID = 4;

$catalogAll = isset($_GET['catalog']) && (string) $_GET['catalog'] === 'all';
$maxItems = $catalogAll ? 100 : 5;

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && (string) $_SERVER['SERVER_PORT'] === '443') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/api/marketplace-top-products.php');
$siteRootPath = dirname(dirname($script));
$origin = ($siteRootPath === '/' || $siteRootPath === '\\' || $siteRootPath === '.')
    ? $scheme . '://' . $host
    : $scheme . '://' . $host . rtrim($siteRootPath, '/');

require_once dirname(__DIR__) . '/includes/products_data.php';

global $PRODUCTS;

$counts = decor_aggregate_load_counts();
$out = [];

$appendProduct = static function (array $p, int $pid, string $origin, array $counts): array {
    $img = (string) ($p['image'] ?? '');
    if ($img !== '' && !preg_match('#^https?://#i', $img)) {
        $img = $origin . '/' . ltrim($img, '/');
    }
    return [
        'name' => (string) ($p['name'] ?? 'Offering'),
        'description' => (string) ($p['description'] ?? ''),
        'category' => 'Interior design',
        'image_url' => $img !== '' ? $img : 'https://placehold.co/600x360/6c757d/ffffff?text=Decor+Dreams',
        'visit_count' => (int) ($counts[(string) $pid] ?? 0),
        'external_url' => $origin . '/product.php?' . http_build_query(['id' => $pid]),
    ];
};

if ($catalogAll) {
    $sortedIds = array_keys($PRODUCTS);
    sort($sortedIds, SORT_NUMERIC);
    foreach ($sortedIds as $pid) {
        $p = get_product((int) $pid);
        if (!$p) {
            continue;
        }
        $out[] = $appendProduct($p, (int) $pid, $origin, $counts);
        if (count($out) >= $maxItems) {
            break;
        }
    }
} else {
    $ids = decor_top_product_ids(20);
    foreach ($ids as $pid) {
        $p = get_product($pid);
        if (!$p) {
            continue;
        }
        $out[] = $appendProduct($p, (int) $pid, $origin, $counts);
        if (count($out) >= $maxItems) {
            break;
        }
    }
}

if ($out === []) {
    foreach ($PRODUCTS as $id => $p) {
        if (count($out) >= $maxItems) {
            break;
        }
        if (!is_array($p)) {
            continue;
        }
        $pid = (int) $id;
        $out[] = $appendProduct($p, $pid, $origin, $counts);
    }
}

echo json_encode(
    ['company_id' => $COMPANY_ID, 'products' => $out],
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
);
