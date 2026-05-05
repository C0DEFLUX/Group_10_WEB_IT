<?php
class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function register(string $username, string $email, string $password): bool
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hash
        ]);
    }

public function findByUsernameOrEmail(string $login): ?array
{
    $stmt = $this->pdo->prepare(
        'SELECT * FROM users WHERE username = :username OR email = :email LIMIT 1'
    );

    $stmt->execute([
        ':username' => $login,
        ':email' => $login
    ]);

    $user = $stmt->fetch();
    return $user ?: null;
}

    public function verifyLogin(string $login, string $password): ?array
    {
        $user = $this->findByUsernameOrEmail($login);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }
}
