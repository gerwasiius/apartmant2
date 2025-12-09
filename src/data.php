<?php
declare(strict_types=1);

// Data layer: fetch apartments and related data from MySQL database
require_once __DIR__ . '/db.php';

/**
 * Load all apartments with images, translations, amenities, and rules from DB
 */
function load_apartments(): array {
  try {
    // Fetch all apartments from DB
    $apartments = db_fetch_all('SELECT * FROM apartments ORDER BY id ASC');

    if (!$apartments) {
      return [];
    }

    // Enrich each apartment with images, translations, amenities, and rules
    foreach ($apartments as &$apt) {
      $apt['id'] = (int) $apt['id'];
      $apt['price'] = (float) $apt['price'];
      $apt['beds'] = (int) $apt['beds'];
      $apt['baths'] = (int) $apt['baths'];
      $apt['guests'] = (int) $apt['guests'];
      $apt['rating'] = (float) $apt['rating'];

      // Get current language
      $lang = current_lang();

      // Fetch translation for current language (fallback to first available)
      $translation = db_fetch_one(
        'SELECT * FROM apartment_translations WHERE apartment_id = ? AND lang = ? LIMIT 1',
        [$apt['id'], $lang]
      );

      if (!$translation) {
        // Fallback: fetch any available translation (e.g., English)
        $translation = db_fetch_one(
          'SELECT * FROM apartment_translations WHERE apartment_id = ? LIMIT 1',
          [$apt['id']]
        );
      }

      if ($translation) {
        $apt['name'] = $translation['name'] ?? '';
        $apt['subName'] = $translation['sub_name'] ?? '';
        $apt['description'] = $translation['description'] ?? '';
        $apt['longDescription'] = $translation['long_description'] ?? '';
      }

      // Fetch images for this apartment
      $images = db_fetch_all(
        'SELECT * FROM images WHERE apartment_id = ? ORDER BY display_order ASC',
        [$apt['id']]
      );
      $apt['images'] = [];
      foreach ($images as $img) {
        $apt['images'][] = [
          'id' => $img['id'],
          'url' => $img['url'],
          'alt' => $img['alt'] ?? '',
          'isFeatured' => (bool) $img['is_featured'],
          'featured' => (bool) $img['is_featured'],
          'order' => (int) $img['display_order'],
        ];
      }

      // Fetch amenities for this apartment
      $amenities = db_fetch_all(
        'SELECT a.label FROM amenities a
         JOIN apartment_amenities aa ON a.id = aa.amenity_id
         WHERE aa.apartment_id = ? ORDER BY a.label ASC',
        [$apt['id']]
      );
      $apt['amenities'] = array_column($amenities, 'label');

      // Fetch house rules for this apartment
      $rules = db_fetch_all(
        'SELECT rule_text FROM house_rules WHERE apartment_id = ? ORDER BY display_order ASC',
        [$apt['id']]
      );
      $apt['rules'] = array_column($rules, 'rule_text');
    }

    return $apartments;
  } catch (Exception $e) {
    error_log('Error loading apartments: ' . $e->getMessage());
    return [];
  }
}

/**
 * Find a single apartment by ID with full details
 */
function find_apartment($id): ?array {
  try {
    $id = (int) $id;
    if ($id <= 0) {
      return null;
    }

    // Fetch apartment base data
    $apt = db_fetch_one('SELECT * FROM apartments WHERE id = ? LIMIT 1', [$id]);
    if (!$apt) {
      return null;
    }

    // Cast numeric fields
    $apt['id'] = (int) $apt['id'];
    $apt['price'] = (float) $apt['price'];
    $apt['beds'] = (int) $apt['beds'];
    $apt['baths'] = (int) $apt['baths'];
    $apt['guests'] = (int) $apt['guests'];
    $apt['rating'] = (float) $apt['rating'];

    // Get current language
    $lang = current_lang();

    // Fetch translation for current language (fallback to first available)
    $translation = db_fetch_one(
      'SELECT * FROM apartment_translations WHERE apartment_id = ? AND lang = ? LIMIT 1',
      [$apt['id'], $lang]
    );

    if (!$translation) {
      // Fallback: fetch any available translation
      $translation = db_fetch_one(
        'SELECT * FROM apartment_translations WHERE apartment_id = ? LIMIT 1',
        [$apt['id']]
      );
    }

    if ($translation) {
      $apt['name'] = $translation['name'] ?? '';
      $apt['subName'] = $translation['sub_name'] ?? '';
      $apt['description'] = $translation['description'] ?? '';
      $apt['longDescription'] = $translation['long_description'] ?? '';
    }

    // Fetch images for this apartment
    $images = db_fetch_all(
      'SELECT * FROM images WHERE apartment_id = ? ORDER BY display_order ASC',
      [$apt['id']]
    );
    $apt['images'] = [];
    foreach ($images as $img) {
      $apt['images'][] = [
        'id' => $img['id'],
        'url' => $img['url'],
        'alt' => $img['alt'] ?? '',
        'isFeatured' => (bool) $img['is_featured'],
        'featured' => (bool) $img['is_featured'],
        'order' => (int) $img['display_order'],
      ];
    }

    // Fetch amenities for this apartment
    $amenities = db_fetch_all(
      'SELECT a.label FROM amenities a
       JOIN apartment_amenities aa ON a.id = aa.amenity_id
       WHERE aa.apartment_id = ? ORDER BY a.label ASC',
      [$apt['id']]
    );
    $apt['amenities'] = array_column($amenities, 'label');

    // Fetch house rules for this apartment
    $rules = db_fetch_all(
      'SELECT rule_text FROM house_rules WHERE apartment_id = ? ORDER BY display_order ASC',
      [$apt['id']]
    );
    $apt['rules'] = array_column($rules, 'rule_text');

    return $apt;
  } catch (Exception $e) {
    error_log('Error finding apartment ' . $id . ': ' . $e->getMessage());
    return null;
  }
}
