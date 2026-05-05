<?php
/**
 * Run once in the browser after creating the MySQL database named webdev_project:
 * http://localhost/webdev_pw3_project/includes/setup.php
 */
require_once __DIR__ . '/db.php';

try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(150) NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(80) NOT NULL UNIQUE,
        email VARCHAR(150) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(120) NOT NULL,
        email VARCHAR(150) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $count = (int)$pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();
    if ($count === 0) {
        $stmt = $pdo->prepare("INSERT INTO services (title, description, image) VALUES (?, ?, ?)");
        $stmt->execute(['Secure Website Audit', 'Security review for common web vulnerabilities and configuration issues.', 'assets/img/service-audit.svg']);
        $stmt->execute(['Responsive Web Design', 'Modern mobile-friendly website layout using HTML, CSS, JavaScript, and Bootstrap.', 'assets/img/service-design.svg']);
        $stmt->execute(['Database Integration', 'Dynamic content management with PHP, PDO, prepared statements, and MySQL.', 'assets/img/service-database.svg']);
    }

    echo '<h1>Setup complete</h1><p>Tables services, users, and messages are ready.</p><p><a href="../index.php">Open website</a></p>';
} catch (PDOException $e) {
    echo '<h1>Setup failed</h1><p>' . htmlspecialchars($e->getMessage()) . '</p>';
}
