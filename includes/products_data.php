<?php
/**
 * Decor Dreams – Products & Services data (10 items)
 * Used by products.php, product.php, and recent.php
 */
$PRODUCTS = [
    1 => [
        'id'    => 1,
        'name'  => 'Living Room Furniture',
        'image' => 'images/furniture-living.jpg',
        'description' => 'Create a welcoming living space with our curated collection of sofas, sectionals, coffee tables, side tables, and entertainment units. Each piece is chosen for comfort, durability, and style—whether you prefer modern minimalism or classic elegance. We offer customizable fabrics and finishes so your furniture fits your lifestyle and aesthetic.',
    ],
    2 => [
        'id'    => 2,
        'name'  => 'Bedroom Furniture',
        'image' => 'images/furniture-bedroom.jpg',
        'description' => 'Transform your bedroom into a restful retreat with our beds, dressers, nightstands, and complete bedroom sets. From upholstered headboards to solid wood dressers, our bedroom collection combines quality craftsmanship with timeless design. Enjoy better sleep and a more organized space with pieces built to last.',
    ],
    3 => [
        'id'    => 3,
        'name'  => 'Dining & Kitchen',
        'image' => 'images/furniture-dining.jpg',
        'description' => 'Gather around the table with our dining tables, chairs, bar stools, and kitchen islands. Whether you host large dinners or casual breakfasts, we have options for every space and style. Choose from extendable tables, mix-and-match seating, and islands that add both function and flair to your kitchen.',
    ],
    4 => [
        'id'    => 4,
        'name'  => 'Lighting',
        'image' => 'images/lighting.jpg',
        'description' => 'Set the right mood with pendant lights, table lamps, floor lamps, and sconces. Our lighting collection balances aesthetics and functionality—statement pieces for focal points and subtle fixtures for ambient glow. Energy-efficient and designer options help you layer light for a warm, inviting home.',
    ],
    5 => [
        'id'    => 5,
        'name'  => 'Wall Art & Mirrors',
        'image' => 'images/wall-art.jpg',
        'description' => 'Give your walls character with prints, canvases, mirrors, and wall décor. Our selection includes everything from bold abstract art to classic mirrors that expand space and reflect light. Mix and match to tell your story and turn blank walls into curated galleries.',
    ],
    6 => [
        'id'    => 6,
        'name'  => 'Rugs & Textiles',
        'image' => 'images/rugs-textiles.jpg',
        'description' => 'Layer comfort and color with area rugs, throw pillows, blankets, and curtains. Our rugs and textiles add texture and warmth while defining zones in open-plan spaces. Choose from natural fibers, easy-care synthetics, and designs that complement your existing furniture and décor.',
    ],
    7 => [
        'id'    => 7,
        'name'  => 'Design Consultation',
        'image' => 'images/design-consultation.jpg',
        'description' => 'One-on-one sessions with our design team to plan layout, color, and style for your space. We help you define your vision, choose the right pieces, and create a cohesive look that reflects your personality. Perfect for a single room refresh or a full-home makeover.',
    ],
    8 => [
        'id'    => 8,
        'name'  => 'Delivery & Assembly',
        'image' => 'images/delivery-service.jpg',
        'description' => 'White-glove delivery and assembly for select items. Our team brings your furniture inside, assembles it with care, and removes packaging—so you can enjoy your new pieces without the hassle. Available for qualifying orders in our service areas.',
    ],
    9 => [
        'id'    => 9,
        'name'  => 'Trade & Wholesale',
        'image' => 'images/wholesale.jpg',
        'description' => 'Special pricing and terms for interior designers, builders, and businesses. Our trade program gives professionals access to our full collection, dedicated support, and flexible ordering. Join our trade network to offer your clients the best in home furnishings.',
    ],
    10 => [
        'id'    => 10,
        'name'  => 'Custom Upholstery',
        'image' => 'images/accents-decor.jpg',
        'description' => 'Make it uniquely yours with custom upholstery on sofas, chairs, and headboards. Choose from hundreds of fabrics and leathers, and we\'ll craft your piece to order. Our artisans ensure a perfect fit and finish, so your furniture is as individual as your home.',
    ],
];

function get_product($id) {
    global $PRODUCTS;
    $id = (int) $id;
    return isset($PRODUCTS[$id]) ? $PRODUCTS[$id] : null;
}

function get_recent_product_ids_from_cookie() {
    if (empty($_COOKIE['recent_products'])) return [];
    $ids = array_map('intval', array_filter(explode(',', $_COOKIE['recent_products'])));
    return array_slice($ids, 0, 5);
}

function update_recent_products_cookie($product_id) {
    $product_id = (int) $product_id;
    if ($product_id < 1) return;
    $recent = isset($_COOKIE['recent_products']) ? explode(',', $_COOKIE['recent_products']) : [];
    $recent = array_map('intval', array_filter($recent));
    array_unshift($recent, $product_id);
    $recent = array_unique($recent);
    $recent = array_slice(array_values($recent), 0, 5);
    setcookie('recent_products', implode(',', $recent), time() + 30 * 24 * 3600, '/');
}
