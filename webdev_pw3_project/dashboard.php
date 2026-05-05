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

$serviceObj = new Service($pdo);
$services = $serviceObj->readAll();

require_once __DIR__ . '/includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Dashboard</h1>
    <a class="btn btn-success" href="add_service.php">Add service</a>
</div>
<?php if (!empty($_GET['deleted'])): ?><div class="alert alert-success">Service deleted.</div><?php endif; ?>
<table class="table table-striped align-middle">
    <thead><tr><th>ID</th><th>Title</th><th>Description</th><th class="text-end">Actions</th></tr></thead>
    <tbody>
    <?php foreach ($services as $service): ?>
        <tr>
            <td><?= (int)$service['id'] ?></td>
            <td><?= htmlspecialchars($service['title']) ?></td>
            <td><?= htmlspecialchars(mb_strimwidth($service['description'], 0, 100, '...')) ?></td>
            <td class="text-end">
                <a class="btn btn-sm btn-primary" href="edit_service.php?id=<?= (int)$service['id'] ?>">Edit</a>
                <a class="btn btn-sm btn-danger" href="delete_service.php?id=<?= (int)$service['id'] ?>" onclick="return confirm('Delete this service?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
