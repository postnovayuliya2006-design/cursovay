<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    exit('Admin only');
}

$corePath = dirname(__DIR__) . '/project-core';

require_once $corePath . '/config/Database.php';
require_once $corePath . '/src/Seeders/CandidateSeeder.php';

$db = Database::getConnection();

$seeder = new CandidateSeeder($db);

try {
    $seeder->run(10);
    echo "Seeder OK: 10 candidates created";
} catch (Exception $e) {
    echo "Seeder ERROR: " . $e->getMessage();
}