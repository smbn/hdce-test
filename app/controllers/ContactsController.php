<?php
require '../app/models/Contact.php';

class ContactsController {

    public function showContactsList() {
        $contacts = Contact::getAllContacts();
        $categories = Contact::getAllCategories();
        require_once('../app/views/contacts-list.php');
    }
}
?>
