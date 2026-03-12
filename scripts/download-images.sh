#!/bin/bash
# Download luxury home decor images from Unsplash (free to use) into images/
# Run from project root: bash scripts/download-images.sh

set -e
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
IMAGES_DIR="$PROJECT_ROOT/images"
mkdir -p "$IMAGES_DIR"

# Unsplash direct image URLs (luxury interiors / home decor) - free under Unsplash License
# Format: URL|local_filename  (use -L to follow redirects)
URLS=(
  "https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1200&q=80|hero.jpg"
  "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80|living-room.jpg"
  "https://images.unsplash.com/photo-1616046229478-9901c5536a45?w=800&q=80|accents-decor.jpg"
  "https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=800&q=80|design-service.jpg"
  "https://images.unsplash.com/photo-1555041469-586c214e6b0d?w=800&q=80|furniture-living.jpg"
  "https://images.unsplash.com/photo-1616594039964-2d2f25efb64d?w=800&q=80|furniture-bedroom.jpg"
  "https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=800&q=80|furniture-dining.jpg"
  "https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?w=800&q=80|lighting.jpg"
  "https://images.unsplash.com/photo-1617802690658-1173a812650d?w=800&q=80|wall-art.jpg"
  "https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800&q=80|rugs-textiles.jpg"
  "https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800&q=80|design-consultation.jpg"
  "https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80|delivery-service.jpg"
  "https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800&q=80|wholesale.jpg"
  "https://images.unsplash.com/photo-1600566752355-35792bedcfea?w=1200&q=80|about-hero.jpg"
  "https://images.unsplash.com/photo-1615874959474-d609969a20ed?w=800&q=80|quality.jpg"
  "https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800&q=80|style.jpg"
  "https://images.unsplash.com/photo-1600607687644-aac4c3eac7f4?w=800&q=80|service.jpg"
  "https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800&q=80|sustainability.jpg"
)

echo "Downloading luxury home decor images to $IMAGES_DIR ..."
for entry in "${URLS[@]}"; do
  url="${entry%%|*}"
  file="${entry##*|}"
  path="$IMAGES_DIR/$file"
  # Re-download if file too small (likely error page)
  size=$(stat -f%z "$path" 2>/dev/null || echo 0)
  if [ -f "$path" ] && [ "$size" -gt 1000 ]; then
    echo "  Skip (exists): $file"
  else
    echo "  Downloading: $file"
    curl -sL -o "$path" "$url" || echo "  Warning: failed $file"
  fi
done
echo "Done. Images are in $IMAGES_DIR"
