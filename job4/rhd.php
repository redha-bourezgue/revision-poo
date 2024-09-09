<?php
require_once 'Product.php'; // Assurez-vous que le chemin est correct

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');

// Requête pour récupérer le produit avec l'id 7
$stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
$stmt->execute(['id' => 7]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Hydratation de l'objet Product
$product = new Product(
    $data['id'],
    $data['name'],
    json_decode($data['photos']), // Assurez-vous que les photos sont en JSON
    $data['price'],
    $data['description'],
    $data['quantity'],
    new DateTime($data['createdAt']),
    new DateTime($data['updatedAt'])
);

var_dump($product);
?>
