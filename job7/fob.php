<?php
class Product {
    // ... autres propriétés et méthodes ...

    public static function findOneById($id) {
        global $pdo; // Utilisez la connexion PDO globale ou passez-la en paramètre
        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Product(
                $data['id'],
                $data['name'],
                json_decode($data['photos']),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt'])
            );
        }

        return false;
    }
}
?>
