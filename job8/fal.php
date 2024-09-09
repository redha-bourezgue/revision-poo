<?php
class Product {
    // ... autres propriétés et méthodes ...

    public static function findAll() {
        global $pdo; // Utilisez la connexion PDO globale ou passez-la en paramètre
        $stmt = $pdo->query('SELECT * FROM product');
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
