<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/classes/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login === '' || $password === '') {
        $errors[] = 'Username/email and password are required.';
    } else {
        $userObj = new User($pdo);
        $user = $userObj->verifyLogin($login, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            setcookie('remembered_username', $user['username'], time() + 60 * 60 * 24 * 30, '/');
            setcookie('last_visit', date('Y-m-d H:i:s'), time() + 60 * 60 * 24 * 30, '/');
            header('Location: dashboard.php');
            exit;
        }
        $errors[] = 'Invalid login details.';
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<h1>Login</h1>
<?php if (!empty($_COOKIE['remembered_username'])): ?>
    <div class="alert alert-info">Welcome back, <?= htmlspecialchars($_COOKIE['remembered_username']) ?>!</div>
<?php endif; ?>
<?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endforeach; ?>
<form method="post" class="col-lg-5" novalidate>
    <div class="mb-3"><label class="form-label">Username or email</label><input class="form-control" name="login" required></div>
    <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div>
    <button class="btn btn-primary" type="submit">Login</button>
</form>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
