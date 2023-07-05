<?php
// Charger le fichier XML existant
$xml = simplexml_load_file('../Modélisation/serviceMessagerie.xml');

// Récupérer la liste des contacts de l'utilisateur u1
$contacts = $xml->xpath("/serviceMessagerie/utilisateurs/utilisateur[@id='u1']/contacts")[0];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des contacts de l'utilisateur u1</title>
    <style>
        /* CSS pour mise en forme de la page */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des contacts</h1>
    <table>
        <tr>
            <th>Nom</th>
            <th>Numéro</th>
        </tr>
        <?php foreach ($contacts->contact as $contact): ?>
            <tr>
                <td><?php echo $contact['nom']; ?></td>
                <td><?php echo $contact['numero']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="serviceMessagerie.php">Ajouter un contact</a>
</body>
</html>
