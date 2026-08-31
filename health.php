<?php

header('Content-Type: application/json');

echo json_encode([
    "status" => "Healthy",
    "application" => "IT Support PHP Portal",
    "version" => "1.0.0",
    "php_version" => PHP_VERSION,
    "timestamp" => gmdate("c")
]);