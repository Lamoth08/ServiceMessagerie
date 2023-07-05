<?php
// Charger le document XML
$xml = simplexml_load_file('../Modélisation/serviceMessagerie.xml');

// Vérifier si le document XML est valide
if ($xml === false) {
    die('Erreur lors du chargement du fichier XML.');
}

// Fonction pour afficher les discussions et les messages d'un utilisateur
function afficherDiscussionsEtMessages($utilisateur)
{
    foreach ($utilisateur->discussions->discussion as $discussion) {
        echo '<h2>ID discussion: ' . $discussion['id'] . '</h2>';

        /*// Affichage des correspondants (contacts ou utilisateurs)
        foreach ($discussion->correspondant as $correspondant) {
            $correspondantId = (string) $correspondant['id'];

            // Rechercher les détails du correspondant dans les contacts ou utilisateurs
            $correspondantDetails = $utilisateur->xpath("//contact[@id='$correspondantId'] | //utilisateur[@id='$correspondantId']");
            if ($correspondantDetails) {
                $correspondantDetails = $correspondantDetails[0];
                echo 'Correspondant Nom: ' . $correspondantDetails['nom'] . '<br>';
                echo 'Correspondant Numéro: ' . $correspondantDetails['numero'] . '<br>';
            }
        }*/

        // Affichage des messages de la discussion
        foreach ($discussion->messages->message as $message) {
            echo '<p>Message ID: ' . $message['id'] . '</p>';
            echo 'Expediteur: ' . $message['expediteur'] . '<br>';
            echo 'Type: ' . $message['type'] . '<br>';
            echo 'Timestamp: ' . $message['timestamp'] . '<br>';

            // Affichage du contenu du message (texte, vocal, fichier, etc.)
            foreach ($message->contenu->children() as $type => $contenu) {
                switch ($type) {
                    case 'texte':
                        echo 'Contenu texte: ' . $contenu . '<br>';
                        break;
                    case 'vocal':
                        echo 'Contenu vocal - Minutes: ' . $contenu['minutes'] . ' Secondes: ' . $contenu['secondes'] . '<br>';
                        break;
                    case 'fichier':
                        echo 'Chemin du fichier: ' . $contenu . '<br>';
                        break;
                    // Ajoutez d'autres cas pour d'autres types de contenu si nécessaire
                }
            }

            // Vérifier si le message cite un autre message
            if ($message->citation) {
                echo 'Citation du message: ' . $message->citation['message'] . '<br>';
            }

            echo '<br>';
        }

        echo '<hr>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Affichage des discussions et des messages</title>
</head>
<body>
    <h1>Liste des discussions et des messages</h1>

    <?php
    // Appeler la fonction pour afficher les discussions et les messages de l'utilisateur 1
    $utilisateur1 = $xml->utilisateurs->utilisateur[0];
    afficherDiscussionsEtMessages($utilisateur1);

    // Appeler la fonction pour afficher les discussions et les messages de l'utilisateur 2
    $utilisateur2 = $xml->utilisateurs->utilisateur[1];
    afficherDiscussionsEtMessages($utilisateur2);
    ?>

</body>
</html>
