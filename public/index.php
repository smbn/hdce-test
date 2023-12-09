<?php
// index.php

require_once('../app/controllers/ContactsController.php');
$contactController = new ContactsController();

$contactController->showContactsList();
