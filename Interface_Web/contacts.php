<?php
function chargerXML() {
    $xmlFile = "../modelisation/serviceMessagerie.xml";
    if (file_exists($xmlFile)) {
        $xml = simplexml_load_file($xmlFile);
        return $xml;
    } else {
        // Gérer le cas où le fichier XML n'existe pas
        return false;
    }
}

function sauvegarderXML($xml) {
    $xmlFile = "../modelisation/serviceMessagerie.xml";
    $xml->asXML($xmlFile);
}

function getNomUtilisateur($id) {
    $xml = chargerXML();
    foreach ($xml->utilisateurs->utilisateur as $utilisateur) {
        if ((string)$utilisateur['id'] == $id) {
            return (string)$utilisateur['nom'];
        }
    }
    return "";
}


function ajouterMessage($expediteur, $destinataire, $message) {
    $xml = chargerXML();

    // Recherche de la discussion correspondante dans le fichier XML
    $discussion = null;
    foreach ($xml->utilisateur->discussions->discussion as $disc) {
        if ($disc['categorie'] == 'individuelle' && (string)$disc->correspondant['id'] == $destinataire) {
            $discussion = $disc;
            break;
        }
    }

    // Ajout du nouveau message dans la discussion
    if ($discussion != null) {
        $nouveauMessage = $discussion->messages->addChild('message');
        $nouveauMessage->addAttribute('expediteur', $expediteur);
        $nouveauMessage->addChild('contenu')->addChild('texte', $message);

        sauvegarderXML($xml);
    }
}

function ajouterContact($contactId) {
    $xml = chargerXML();

    // Vérification si le contact existe déjà
    $existeDeja = false;
    foreach ($xml->utilisateur->contacts->contact as $contact) {
        if ((string)$contact['id'] == $contactId) {
            $existeDeja = true;
            break;
        }
    }

    // Ajout du contact si non existant
    if (!$existeDeja) {
        $nouveauContact = $xml->utilisateur->contacts->addChild('contact');
        $nouveauContact->addAttribute('id', $contactId);

        sauvegarderXML($xml);
    }
}

function ajouterDiscussion($discussionId, $categorie) {
    $xml = chargerXML();

    // Vérification si la discussion existe déjà
    $existeDeja = false;
    foreach ($xml->utilisateur->discussions->discussion as $discussion) {
        if ((string)$discussion['id'] == $discussionId) {
            $existeDeja = true;
            break;
        }
    }

    // Ajout de la discussion si non existante
    if (!$existeDeja) {
        $nouvelleDiscussion = $xml->utilisateur->discussions->addChild('discussion');
        $nouvelleDiscussion->addAttribute('id', $discussionId);
        $nouvelleDiscussion->addAttribute('categorie', $categorie);

        sauvegarderXML($xml);
    }
}
?>