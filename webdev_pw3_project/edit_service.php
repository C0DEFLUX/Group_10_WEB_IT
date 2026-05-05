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
$id = (int)($_GET['id'] ?? 0);
$service = $serviceObj->readById($id);
if (!$service) {
    header('Location: dashboard.php');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $desc = trim($_POST['description'] ?? '');

    if ($title === '') $errors[] = 'Title is required.';
    if ($desc === '') $errors[] = 'Description is required.';

    if (!$errors) {
        $serviceObj->update($id, $title, $desc);
        header('Location: dashboard.php');
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<h1>Edit service</h1>
<?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endforeach; ?>
<form method="post" class="col-lg-7" novalidate>
    <div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="title" value="<?= htmlspecialchars($service['title']) ?>" required></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="5" required><?= htmlspecialchars($service['description']) ?></textarea></div>
    <button class="btn btn-primary" type="submit">Update</button>
    <a class="btn btn-secondary" href="dashboard.php">Cancel</a>
</form>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
