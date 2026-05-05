<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/classes/Message.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $messageText = trim($_POST['message'] ?? '');

    if (strlen($name) < 2) $errors[] = 'Name must be at least 2 characters.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';
    if (strlen($messageText) < 10) $errors[] = 'Message must be at least 10 characters.';

    if (!$errors) {
        $message = new Message($pdo);
        if ($message->create($name, $email, $messageText)) {
            $success = 'Your message has been saved successfully.';
        } else {
            $errors[] = 'Message could not be saved.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<h1>Contact</h1>
<?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
<?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endforeach; ?>
<form method="post" class="col-lg-7" id="contactForm" novalidate>
    <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="name" id="name" required minlength="2"></div>
    <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" id="email" required></div>
    <div class="mb-3"><label class="form-label">Message</label><textarea class="form-control" name="message" id="message" rows="6" required minlength="10"></textarea></div>
    <div id="clientError" class="alert alert-danger d-none"></div>
    <button class="btn btn-primary" type="submit">Send message</button>
</form>
<script src="assets/js/contact.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
