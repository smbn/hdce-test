<!-- Le popup -->
<div id="add-contact-popup" class="popup">
    <div class="popup-content">
        <h5 class="titl2">Formulaire Contact</h5>
        <span class="close-popup" onclick="closeAddContactPopup()">&times;</span>
        <!-- Formulaire d'ajout de contact -->
        <form id="add-contact-form">
            <div class="mb-3"><label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="mb-3"><label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>

            <div class="mb-3">
                <label for="categorie">Catégorie:</label>
                <select name="categorie" id="categorie">
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie['id'] ?>"><?= $categorie['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <button class="btn btn-light " type="button" onclick="closeAddContactPopup()">Fermer</button>
                <button class="btn btn-secondary " type="button" onclick="addContact()">Ajouter</button>
            </div>
        </form>
    </div>
</div>