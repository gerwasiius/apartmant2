<?php
declare(strict_types=1);

function load_apartments(): array {
  $path = __DIR__ . '/../data/apartments.json';
  $json = @file_get_contents($path);
  if ($json === false) { return []; }
  $data = json_decode($json, true);
  return is_array($data) ? $data : [];
}

function find_apartment($id): ?array {
  foreach (load_apartments() as $a) {
    if ((string)$a['id'] === (string)$id) { return $a; }
  }
  return null;
}
