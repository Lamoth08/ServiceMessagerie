<?php
// Vérifier si les identifiants de discussion et de correspondant sont présents dans l'URL
if (isset($_GET['discussion_id']) && isset($_GET['correspondant_id'])) {
    $discussion_id = $_GET['discussion_id'];
    $correspondant_id = $_GET['correspondant_id'];

    // Charger le fichier XML existant
    $xml = simplexml_load_file('../Modélisation/serviceMessagerie.xml');

    // Récupérer les messages de la discussion et du correspondant spécifiés
    $messages = $xml->xpath('/serviceMessagerie/utilisateurs/utilisateur/discussions/discussion[@id="' . $discussion_id . '"]/messages/message[@correspondant="' . $correspondant_id . '"]');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages de la discussion</title>
    <style>
        /* CSS pour mise en forme de la page */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f2f2f2;
        }

        .message .expediteur {
            font-weight: bold;
        }

        .message .date {
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>Messages de la discussion</h1>
    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $message): ?>
            <div class="message">
                <div class="expediteur"><?php echo $message['expediteur']; ?></div>
                <div class="date"><?php echo $message['date']; ?></div>
                <div class="contenu"><?php echo $message->contenu; ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun message trouvé.</p>
    <?php endif; ?>
</body>
</html>
