<?php
// Charger le document XML

$xml = simplexml_load_file('../Modélisation/serviceMessagerie.xml');

// Vérifier si le document XML est valide
if ($xml === false) {
    die('Erreur lors du chargement du fichier XML.');
}

// Fonction pour afficher les utilisateurs et leurs contacts
function afficherUtilisateurs($xml)
{
    // Affichage des utilisateurs
    foreach ($xml->utilisateurs->utilisateur as $utilisateur) {
        echo 'ID utilisateur: ' . $utilisateur['id'] . '<br>';
        echo 'Nom: ' . $utilisateur['nom'] . '<br>';
        echo 'Numéro: ' . $utilisateur['numero'] . '<br>';
        echo 'Statut: ' . $utilisateur['statut'] . '<br>';

        // Affichage des contacts de l'utilisateur
        foreach ($utilisateur->contacts->contact as $contact) {
            echo 'ID contact: ' . $contact['id'] . '<br>';
            echo 'Nom: ' . $contact['nom'] . '<br>';
            echo 'Numéro: ' . $contact['numero'] . '<br>';
            echo 'Statut: ' . $contact['statut'] . '<br>';

            // Vérification de la présence d'une photo pour le contact
            if ($contact->photo) {
                echo 'Photo: ' . $contact->photo . '<br>';
            }

            // Vérification de la présence de groupes pour le contact
            if ($contact->Groupes) {
                // Affichage des groupes du contact
                foreach ($contact->Groupes->Groupe as $groupe) {
                    echo 'ID groupe: ' . $groupe['id'] . '<br>';
                }
            }

            echo '<br>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Affichage des utilisateurs et des contacts</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>

    <?php
    // Appeler la fonction pour afficher les utilisateurs et leurs contacts
    afficherUtilisateurs($xml);
    ?>

</body>
</html>
