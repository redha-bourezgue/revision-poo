<?php
class Clothing extends AbstractProduct {
    private $size;
    private $color;
    private $type;
    private $material_fee;

    public function __construct($id = null, $name = null, array $photos = [], $price = null, $description = null, $quantity = null, DateTime $createdAt = null, DateTime $updatedAt = null, $size = null, $color = null, $type = null, $material_fee = null) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt);
        $this->size = $size;
        $this->color = $color;
        $this->type = $type;
        $this->material_fee = $material_fee;
    }

    // Getters and Setters
    public function getSize() { return $this->size; }
    public function setSize($size) { $this->size = $size; }

    public function getColor() { return $this->color; }
    public function setColor($color) { $this->color = $color; }

    public function getType() { return $this->type; }
    public function setType($type) { $this->type = $type; }

    public function getMaterialFee() { return $this->material_fee; }
    public function setMaterialFee($material_fee) { $this->material_fee = $material_fee; }

    // Méthodes spécifiques
    public static function findOneById($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM product INNER JOIN clothing ON product.id = clothing.product_id WHERE product.id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Clothing(
                $data['id'],
                $data['name'],
                json_decode($data['photos']),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['size'],
                $data['color'],
                $data['type'],
                $data['material_fee']
            );
        }

        return false;
    }

    public static function findAll() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM product INNER JOIN clothing ON product.id = clothing.product_id');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clothes = [];
        foreach ($data as $row) {
            $clothes[] = new Clothing(
                $row['id'],
                $row['name'],
                json_decode($row['photos']),
                $row['price'],
                $row['description'],
                $row['quantity'],
                new DateTime($row['createdAt']),
                new DateTime($row['updatedAt']),
                $row['size'],
                $row['color'],
                $row['type'],
                $row['material_fee']
            );
        }

        return $clothes;
    }

    public function create() {
        global $pdo;
        $pdo->beginTransaction();

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
            $productId = $pdo->lastInsertId();
            $stmt = $pdo->prepare('INSERT INTO clothing (product_id, size, color, type, material_fee) VALUES (:product_id, :size, :color, :type, :material_fee)');
            $result = $stmt->execute([
                'product_id' => $productId,
                'size' => $this->size,
                'color' => $this->color,
                'type' => $this->type,
                'material_fee' => $this->material_fee
            ]);

            if ($result) {
                $pdo->commit();
                $this->id = $productId;
                return $this;
            } else {
                $pdo->rollBack();
            }
        }

        return false;
    }

    public function update() {
        global $pdo;
        $pdo->beginTransaction();

        $stmt = $pdo->prepare('UPDATE product SET name = :name, photos = :photos, price = :price, description = :description, quantity = :quantity, createdAt = :createdAt, updatedAt = :updatedAt, category_id = :category_id WHERE id = :id');
        $result = $stmt->execute([
            'name' => $this->name,
            'photos' => json_encode($this->photos),
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id,
            'id' => $this->id
        ]);

        if ($result) {
            $stmt = $pdo->prepare('UPDATE clothing SET size = :size, color = :color, type = :type, material_fee = :material_fee WHERE product_id = :product_id');
            $result = $stmt->execute([
                'size' => $this->size,
                'color' => $this->color,
                'type' => $this->type,
                'material_fee' => $this->material_fee,
                'product_id' => $this->id
            ]);

            if ($result) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollBack();
            }
        }

        return false;
    }
}
?>


<?php
class Electronic extends AbstractProduct {
    private $brand;
    private $warranty_fee;

    public function __construct($id = null, $name = null, array $photos = [], $price = null, $description = null, $quantity = null, DateTime $createdAt = null, DateTime $updatedAt = null, $brand = null, $warranty_fee = null) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt);
        $this->brand = $brand;
        $this->warranty_fee = $warranty_fee;
    }

    // Getters and Setters
    public function getBrand() { return $this->brand; }
    public function setBrand($brand) { $this->brand = $brand; }

    public function getWarrantyFee() { return $this->warranty_fee; }
    public function setWarrantyFee($warranty_fee) { $this->warranty_fee = $warranty_fee; }

    // Méthodes spécifiques
    public static function findOneById($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id WHERE product.id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Electronic(
                $data['id'],
                $data['name'],
                json_decode($data['photos']),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['brand'],
                $data['warranty_fee']
            );
        }

        return false;
    }

    public static function findAll() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $electronics = [];
        foreach ($data as $row) {
            $electronics[] = new Electronic(
                $row['id'],
                $row['name'],
                json_decode($row['photos']),
                $row['price'],
                $row['description'],
                $row['quantity'],
                new DateTime($row['createdAt']),
                new DateTime($row['updatedAt']),
                $row['brand'],
                $row['warranty_fee']
            );
        }

        return $electronics;
    }

    public function create() {
        global $pdo;
        $pdo->beginTransaction();

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
            $productId = $pdo->lastInsertId();
            $stmt = $pdo->prepare('INSERT INTO electronic (product_id, brand, warranty_fee) VALUES (:product_id, :brand, :warranty_fee)');
            $result = $stmt->execute([
                'product_id' => $productId,
                'brand' => $this->brand,
                'warranty_fee' => $this->warranty_fee
            ]);

            if ($result) {
                $pdo->commit();
                $this->id = $productId;
                return $this;
            } else {
                $pdo->rollBack();
            }
        }

        return false;
    }

    public function update() {
        global $pdo;
        $pdo->beginTransaction();

        $stmt = $pdo->prepare('UPDATE product SET name = :name, photos = :photos, price = :price, description = :description, quantity = :quantity, createdAt = :createdAt, updatedAt = :updatedAt, category_id = :category_id WHERE id = :id');
        $result = $stmt->execute([
            'name' => $this->name,
            'photos' => json_encode($this->photos),
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id,
            'id' => $this->id
        ]);

        if ($result) {
            $stmt = $pdo->prepare('UPDATE electronic SET brand = :brand, warranty_fee = :warranty_fee WHERE product_id = :product_id');
            $result = $stmt->execute([
                'brand' => $this->brand,
                'warranty_fee' => $this->warranty_fee,
                'product_id' => $this->id
            ]);

            if ($result) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollBack();
            }
        }

        return false;
    }
}
?>
