<?php
require_once '../app/config/db.php';

class Contact
{
    public static function getAllContacts()
    {

        $sql = "SELECT contact.*, categorie.libelle FROM contact JOIN categorie ON contact.categorie_id = categorie.id";
        $result = executeQuery($sql);

        $contacts = [];

        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }

        return $contacts;
    }

    public static function getContactDetails($contactId)
    {

        $contactId = escapeString($contactId);

        $sql = "SELECT contact.*, categorie.libelle FROM contact JOIN categorie ON contact.categorie_id = categorie.id WHERE contact.id = $contactId";
        $result = executeQuery($sql);

        return $result->fetch_assoc();
    }

    public static function getAllCategories()
    {

        $sql = "SELECT * FROM categorie";
        $result = executeQuery($sql);

        $categories = [];

        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return $categories;
    }

    public static function updateContact($contactId, $updatedValues)
    {
        global $conn;
        try {
            // Construire la requête SQL pour la mise à jour
            $sql = "UPDATE contact SET ";
            foreach ($updatedValues as $column => $value) {
                $sql .= "$column = ?, ";
            }
            $sql = rtrim($sql, ', '); // Supprime la virgule finale
            $sql .= " WHERE id = ?";

            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // Liaison des paramètres
            $params = array_values($updatedValues);
            $params[] = $contactId;

            $stmt->bind_param(str_repeat('s', count($params)), ...$params);

            // Exécution de la requête
            $stmt->execute();

            // Fermeture du statement
            $stmt->close();

            return true; // Succès de la mise à jour
        } catch (Exception $e) {
            // Gestion des erreurs
            return false;
        }
    }

    public static function addContact($contactData)
    {
        global $conn;

        try {
            // Construire la requête SQL pour l'ajout de contact
            $sql = "INSERT INTO contact (nom, prenom, categorie_id) VALUES (?, ?, ?)";

            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // Liaison des paramètres
            $stmt->bind_param("ssi", $contactData['nom'], $contactData['prenom'], $contactData['categorie']);

            // Exécution de la requête
            $stmt->execute();

            // Fermeture du statement
            $stmt->close();

            return true; // Succès de l'ajout
        } catch (Exception $e) {
            // Gestion des erreurs
            return false;
        }
    }
}
