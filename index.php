<?php

/**
 * Reprenez le code de l'exercice précédent et transformez vos requêtes pour utiliser les requêtes préparées
 * la méthode de bind du paramètre et du choix du marqueur de données est à votre convenance.
 */


require "connPDO.php";

try {
    /**
     * Créez ici votre objet de connection PDO, et utilisez à chaque fois le même objet $pdo ici.
     */
    $pdo = new connPDO();
    $connect = $pdo->conn();

    // add user
    $stm = $connect->prepare("
        INSERT INTO user (name, firstname, email, password, adress, cp, country)
        VALUES (:name, :firstname, :email, :password, :adress, :cp, :country)
    ");

//    $stm->execute([
//        ':name' => 'Bataille',
//        ':firstname' => 'Sylvie',
//        ':email' => 'bs@syl.fr',
//        ':password' => 'azerty',
//        ':adress' => '14 rue du moulin',
//        ':cp' => '59610',
//        ':country' => 'Fourmies',
//    ]);

//    echo "utilisateur ajouté";

    // add product
    $title = 'droid R2D2';
    $price = 1500;
    $shortD = 'droid co-pilote';
    $description = 'able to drive and fix xwing';

    $stm = $connect->prepare("
        INSERT INTO product (title, price, shortDescription, description)
        VALUES (:title, :price, :shortDescription, :description)
    ");

    $stm->bindParam(':title', $title);
    $stm->bindParam(':price', $price);
    $stm->bindParam(':shortDescription', $shortD);
    $stm->bindParam(':description', $description);

    $stm->execute();

    echo "Produit ajouté";



}
catch (PDOException $e){
    echo "Error : " . $e->getMessage() . "<br>";
    $connect->rollBack();
}

