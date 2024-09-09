<?php
class Category {
    // ... autres propriétés et méthodes ...

    public function getProducts() {
        global $pdo; // Utilisez la connexion PDO globale ou passez-la en paramètre
        $stmt = $pdo->prepare('SELECT * FROM product WHERE category_id = :category_id');
        $stmt->execute(['category_id' => $this->id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($data as $row) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                json_decode($row['photos']),
                $row['price'],
                $row['description'],
                $row['quantity'],
                new DateTime($row['createdAt']),
                new DateTime($row['updatedAt'])
            );
        }

        return $products;
    }
}
?>

