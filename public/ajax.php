<?php
// app/ajax.php
require_once '../app/models/Contact.php';

$action = isset($_GET['action']) ? $_GET['action'] : $_POST['action'];

switch ($action) {
    case 'getContactDetails':
        $contactId = isset($_GET['contactId']) ? $_GET['contactId'] : null;
        if ($contactId !== null) {
            $contactDetails = Contact::getContactDetails($contactId);
            echo json_encode($contactDetails);
        } else {
            echo json_encode(['error' => 'Invalid contact ID']);
        }
        break;
    case 'updateContact':
        $contactId = isset($_POST['contactId']) ? $_POST['contactId'] : null;
        $updatedValues = isset($_POST['updatedValues']) ? $_POST['updatedValues'] : null;
        if ($contactId !== null && $updatedValues !== null) {
            Contact::updateContact($contactId, $updatedValues);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Invalid contact ID or updated values']);
        }
        break;
    case 'addContact':
        $contactData = isset($_POST['contactData']) ? $_POST['contactData'] : null;
        if ($contactData !== null) {
            $success = Contact::addContact($contactData);
            if ($success) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Error adding contact']);
            }
        } else {
            echo json_encode(['error' => 'Invalid contact data']);
        }
        break;
    case 'getAllContacts':
        $contacts = Contact::getAllContacts();
        // Génération du HTML pour la liste des contacts
        $html = '';
        foreach ($contacts as $contact) {
            $html .= '<tr class="show-details" data-contact-id="' .  $contact['id'] . '">';
            $html .= '<td>' . $contact['nom'] . '</td>';
            $html .= '<td>' . $contact['prenom'] . '</td>';
            $html .= '<td>' . $contact['libelle'] . '</td>';
            $html .= '</tr>';
        }
        echo $html;
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
}
