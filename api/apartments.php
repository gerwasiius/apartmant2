<?php
require __DIR__ . "/../data.php";
header("Content-Type: application/json; charset=utf-8");
echo json_encode(load_apartments(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
