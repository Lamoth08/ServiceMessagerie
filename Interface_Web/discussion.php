<?php
// Vérifier si les paramètres discussion_id et correspondant_id sont présents dans l'URL
if (isset($_GET['discussion_id']) && isset($_GET['correspondant_id'])) {
    $discussion_id = $_GET['discussion_id'];
    $correspondant_id = $_GET['correspondant_id'];

    // Charger le fichier XML des discussions
    $xml = simplexml_load_file('../Modélisation/serviceMessagerie.xml');

    // Récupérer les messages de la discussion entre l'utilisateur u1 et le correspondant sélectionné
    $messages = $xml->xpath("/serviceMessagerie/discussions/discussion[@id='$discussion_id' and ((@correspondant1='u1' and @correspondant2='$correspondant_id') or (@correspondant1='$correspondant_id' and @correspondant2='u1'))]");

    // Afficher les messages de la discussion
    if (!empty($messages)) {
        echo "<h1>Discussion</h1>";
        echo "<ul>";
        foreach ($messages[0]->message as $message) {
            $sender = $message['sender'];
            $contenu = $message->contenu;
            echo "<li><strong>$sender:</strong> $contenu</li>";
        }
        echo "</ul>";
    } else {
        echo "Aucune discussion trouvée.";
    }
} else {
    echo "Paramètres manquants.";
}
?>
