<?php
require __DIR__ . "/../data.php";
header("Content-Type: application/json; charset=utf-8");
$id = $_GET['id'] ?? null;
$apt = $id ? find_apartment($id) : null;
if (!$apt) { http_response_code(404); echo json_encode(["error"=>"Not found"]); exit; }
echo json_encode($apt, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
