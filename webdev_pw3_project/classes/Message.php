<?php
class Message
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $name, string $email, string $message): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)');
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        ]);
    }
}
