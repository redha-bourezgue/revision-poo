<?php
class Product {
    // ... autres propriétés ...

    public function __construct(
        $id = null,
        $name = '',
        array $photos = [],
        $price = 0,
        $description = '',
        $quantity = 0,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt ?: new DateTime();
        $this->updatedAt = $updatedAt ?: new DateTime();
    }
}
?>
