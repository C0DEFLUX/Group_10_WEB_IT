<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/classes/User.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (strlen($username) < 3) {
        $errors[] = 'Username must be at least 3 characters.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }
    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$errors) {
        try {
            $user = new User($pdo);
            $user->register($username, $email, $password);
            $success = 'Registration successful. You can now log in.';
        } catch (PDOException $e) {
            $errors[] = 'Username or email already exists.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<h1>Register</h1>
<?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
<?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endforeach; ?>
<form method="post" class="col-lg-6" novalidate>
    <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required minlength="3"></div>
    <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" required></div>
    <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required minlength="6"></div>
    <div class="mb-3"><label class="form-label">Confirm password</label><input class="form-control" type="password" name="confirm_password" required minlength="6"></div>
    <button class="btn btn-primary" type="submit">Create account</button>
</form>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
