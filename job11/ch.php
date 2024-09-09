<?php
class Clothing extends Product {
    private $size;
    private $color;
    private $type;
    private $material_fee;

    public function __construct($id, $name, array $photos, $price, $description, $quantity, DateTime $createdAt, DateTime $updatedAt, $size, $color, $type, $material_fee) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt);
        $this->size = $size;
        $this->color = $color;
        $this->type = $type;
        $this->material_fee = $material_fee;
    }

    // Getters and Setters
    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getMaterialFee() {
        return $this->material_fee;
    }

    public function setMaterialFee($material_fee) {
        $this->material_fee = $material_fee;
    }
}

class Electronic extends Product {
    private $brand;
    private $warranty_fee;

    public function __construct($id, $name, array $photos, $price, $description, $quantity, DateTime $createdAt, DateTime $updatedAt, $brand, $warranty_fee) {
        parent::__construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt);
        $this->brand = $brand;
        $this->warranty_fee = $warranty_fee;
    }

    // Getters and Setters
    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getWarrantyFee() {
        return $this->warranty_fee;
    }

    public function setWarrantyFee($warranty_fee) {
        $this->warranty_fee = $warranty_fee;
    }
}
?>
