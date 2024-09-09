<?php
class Product {
    // ... autres propriétés et méthodes ...

    public function create() {
        global $pdo; // Utilisez la connexion PDO globale ou passez-la en paramètre

        $stmt = $pdo->prepare('INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id) VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)');
        $result = $stmt->execute([
            'name' => $this->name,
            'photos' => json_encode($this->photos),
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id
        ]);

        if ($result) {
            $this->id = $pdo->lastInsertId();
            return $this;
        }

        return false;
    }
}
?>
