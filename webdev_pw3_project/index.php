<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

$welcome = '';
if (!empty($_SESSION['username'])) {
    $welcome = 'Welcome, ' . htmlspecialchars($_SESSION['username']) . '!';
} elseif (!empty($_COOKIE['remembered_username'])) {
    $welcome = 'Welcome back, ' . htmlspecialchars($_COOKIE['remembered_username']) . '!';
}

$lastVisit = $_COOKIE['last_visit'] ?? null;
?>
<section class="p-5 mb-4 bg-body-tertiary rounded-3">
    <div class="container-fluid py-4">
        <h1 class="display-5 fw-bold">Secure Web Development Services</h1>
        <p class="col-md-8 fs-5">A dynamic PHP and MySQL website demonstrating authentication, sessions, cookies, CRUD, search, and form validation.</p>
        <?php if ($welcome): ?>
            <div class="alert alert-info mb-3">
                <?= $welcome ?><?= $lastVisit ? ' Last visit: ' . htmlspecialchars($lastVisit) : '' ?>
            </div>
        <?php endif; ?>
        <a class="btn btn-primary btn-lg" href="services.php">View services</a>
    </div>
</section>

<div class="row g-4">
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h5">PHP + PDO</h2><p>Database access uses PDO and prepared statements.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h5">Authentication</h2><p>Users can register, log in, log out, and access an admin dashboard.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h5">CRUD</h2><p>Services can be created, displayed, updated, searched, and deleted.</p></div></div></div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
