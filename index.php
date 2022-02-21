<?php
/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées, si vous le souhaitez vous pouvez en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

// TODO Votre code ici.
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bdd_cours;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = 'nom';
    $firstName = 'prenom';
    $address = 'rue';
    $number = 10;
    $zip_code = 10101;
    $city = 'ville';
    $country = 'pays';
    $email = 'email';

    $stmt = $pdo->prepare("
        INSERT INTO user (nom, prenom, rue, numero, code_postal, ville, pays, mail)
        VALUES (:name, :firstName, :address, :number, :zip_code, :city, :country, :email)    
    ");

    $stmt->bindParam('name', $name);
    $stmt->bindParam('firstName', $firstName);
    $stmt->bindParam('address', $address);
    $stmt->bindParam('number', $number);
    $stmt->bindParam('zip_code', $zip_code);
    $stmt->bindParam('city', $city);
    $stmt->bindParam('country', $country);
    $stmt->bindParam('email', $email);

    $result = $stmt->execute();

    if($result) {
         $id = $pdo->lastInsertId();
         $stmt = $pdo->prepare("UPDATE user SET nom = :name WHERE id = :id");

         $name2 = 'Name2';

        $stmt->bindParam('name', $name2);
        $stmt->bindParam('id', $id);

        $stmt->execute();
    }

}
catch (PDOException $e) {
    echo $e;
}



/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */