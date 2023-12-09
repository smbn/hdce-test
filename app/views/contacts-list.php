<!-- views/contact-list.php -->
<?php include('layouts/header.php'); ?>
<div class="container">
    <div class="row1">
        <h1 class="titl">Liste de Contact</h1>
        <button id="add-contact-btn" class="btn btn-primary">Ajouter</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody id="contacts-list">
            <?php foreach ($contacts as $contact) : ?>
                <tr class="show-details" data-contact-id="<?= $contact['id'] ?>">
                    <td><?= $contact['nom'] ?></td>
                    <td><?= $contact['prenom'] ?></td>
                    <td><?= $contact['libelle'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Popup pour les détails du contact -->
    <?php include("../app/views/modals/details-modal.php") ?>
    <!-- Popup pour le formulaire de contact -->
    <?php include("../app/views/modals/insert-modal.php") ?>
</div>
<?php include('layouts/footer.php'); ?>