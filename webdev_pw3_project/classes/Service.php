<?php
class Service
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($title, $desc, $img): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO services (title, description, image) VALUES (:title, :description, :image)');
        return $stmt->execute([
            ':title' => $title,
            ':description' => $desc,
            ':image' => $img
        ]);
    }

    public function readAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM services ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function search(string $keyword): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM services WHERE title LIKE :keyword OR description LIKE :keyword ORDER BY id DESC');
        $stmt->execute([':keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll();
    }

    public function readById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM services WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $service = $stmt->fetch();
        return $service ?: null;
    }

    public function update($id, $title, $desc): bool
    {
        $stmt = $this->pdo->prepare('UPDATE services SET title = :title, description = :description WHERE id = :id');
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $desc
        ]);
    }

    public function delete($id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM services WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
