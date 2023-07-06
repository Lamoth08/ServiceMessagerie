<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les informations du formulaire
    $nom = $_POST['nom'];
    $numero = $_POST['numero'];

    // Charger le fichier XML existant
    

    $xml = simplexml_load_file('../Modélisation/serviceMessagerie.xml');
    if($xml){
        echo "Le document XML a bien été chargé.";
    }
    $utilisateur = $xml->xpath("/serviceMessagerie/utilisateurs/utilisateur[@id='u1']")[0];

    // Créer un nouvel élément contact
    $nouveauContact = $utilisateur->contacts->addChild('contact');
    $nouveauContact->addAttribute('id', 'c' . (count($utilisateur->contacts->contact) + 1));
    $nouveauContact->addAttribute('nom', $nom);
    $nouveauContact->addAttribute('numero', $numero);

    // Enregistrer les modifications dans le fichier XML
    $xml->asXML('../Modélisation/serviceMessagerie.xml');

    // Rediriger vers la page index.php
    header('Location: contacts.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un contact</title>
    <style>
        /* CSS pour mise en forme de la page */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 300px;
            padding: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Ajouter un contact</h1>
    <form method="post" action="">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="numero">Numéro :</label>
        <input type="text" id="numero" name="numero" required>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
