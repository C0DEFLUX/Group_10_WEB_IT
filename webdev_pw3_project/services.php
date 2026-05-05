<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/classes/Service.php';

$serviceObj = new Service($pdo);
$keyword = trim($_GET['q'] ?? '');
$services = $keyword !== '' ? $serviceObj->search($keyword) : $serviceObj->readAll();

require_once __DIR__ . '/includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Services</h1>
</div>
<form method="get" class="row g-2 mb-4">
    <div class="col-md-10"><input class="form-control" name="q" value="<?= htmlspecialchars($keyword) ?>" placeholder="Search services by keyword"></div>
    <div class="col-md-2 d-grid"><button class="btn btn-outline-primary" type="submit">Search</button></div>
</form>
<div class="row g-4">
    <?php if (!$services): ?>
        <div class="col-12"><div class="alert alert-warning">No services found.</div></div>
    <?php endif; ?>
    <?php foreach ($services as $service): ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <?php if (!empty($service['image'])): ?>
                    <img src="<?= htmlspecialchars($service['image']) ?>" class="card-img-top service-img" alt="<?= htmlspecialchars($service['title']) ?>">
                <?php endif; ?>
                <div class="card-body">
                    <h2 class="card-title h5"><?= htmlspecialchars($service['title']) ?></h2>
                    <p class="card-text"><?= htmlspecialchars($service['description']) ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
