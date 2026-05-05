<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/classes/Service.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $serviceObj = new Service($pdo);
    $serviceObj->delete($id);
}
header('Location: dashboard.php?deleted=1');
exit;
