<?php
class Product {
    // ... autres propriétés et méthodes ...

    public function getCategory() {
        global $pdo; // Utilisez la connexion PDO globale ou passez-la en paramètre
        $stmt = $pdo->prepare('SELECT * FROM category WHERE id = :id');
        $stmt->execute(['id' => $this->category_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Category(
            $data['id'],
            $data['name'],
            $data['description'],
            new DateTime($data['createdAt']),
            new DateTime($data['updatedAt'])
        );
    }
}
?>
