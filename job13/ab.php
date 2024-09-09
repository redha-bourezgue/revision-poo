<?php
abstract class AbstractProduct {
    protected $id;
    protected $name;
    protected $photos;
    protected $price;
    protected $description;
    protected $quantity;
    protected $createdAt;
    protected $updatedAt;
    protected $category_id;

    public function __construct($id = null, $name = null, array $photos = [], $price = null, $description = null, $quantity = null, DateTime $createdAt = null, DateTime $updatedAt = null, $category_id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
        $this->category_id = $category_id;
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function getPhotos() { return $this->photos; }
    public function setPhotos(array $photos) { $this->photos = $photos; }

    public function getPrice() { return $this->price; }
    public function setPrice($price) { $this->price = $price; }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getQuantity() { return $this->quantity; }
    public function setQuantity($quantity) { $this->quantity = $quantity; }

    public function getCreatedAt() { return $this->createdAt; }
    public function setCreatedAt(DateTime $createdAt) { $this->createdAt = $createdAt; }

    public function getUpdatedAt() { return $this->updatedAt; }
    public function setUpdatedAt(DateTime $updatedAt) { $this->updatedAt = $updatedAt; }

    public function getCategoryId() { return $this->category_id; }
    public function setCategoryId($category_id) { $this->category_id = $category_id; }

    // Méthodes abstraites
    abstract public function create();
    abstract public function update();
}
?>
