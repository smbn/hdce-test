// script.js - Script pour la gestion des interactions côté client

$(document).ready(function () {
  // Affichage les détails du contact au clic sur une ligne
  $(document).on("click", ".show-details", function () {
    var contactId = $(this).data("contact-id");
    loadContactDetails(contactId);
    openPopup();
  });

  // Fermer la modal au clic sur la croix
  $(document).on("click", ".close", function () {
    $("#contact-modal").hide();
  });

  $(document).on("click", "#add-contact-btn", function () {
    openAddContactPopup();
  });

  // Fermer la modal au clic sur la croix
  $(document).on("click", ".close", function () {
    closeAddContactPopup();
  });
});

function openPopup() {
  $("#contact-popup").show();
}

function closePopup() {
  $("#contact-popup").hide();
}

function openAddContactPopup() {
  $("#add-contact-popup").show();
}

function closeAddContactPopup() {
  $("#add-contact-popup").hide();
}

var currentContactId;

function loadContactDetails(contactId) {
  currentContactId = contactId;
  // Appel Ajax pour charger les détails du contact
  $.ajax({
    url: "ajax.php",
    type: "GET",
    data: { action: "getContactDetails", contactId: contactId },
    success: function (response) {
      var contactDetails = JSON.parse(response);

      var htmlContent = '<form id="edit-form">';
      for (var key in contactDetails) {
        if (contactDetails.hasOwnProperty(key) && key != 'id' && key != 'categorie_id') {
          htmlContent +=
            "<p><strong>" +
            key +
            ':</strong> <input id="' +
            key +
            '" value="' +
            contactDetails[key] +
            '"/></p>';
        }
      }
      htmlContent += "</form>";

      // Affiche le contenu dans le popup
      $("#contact-details-content").html(htmlContent);
    },
  });
}

function editContact() {
  var editedValues = {};
  $("#edit-form input").each(function () {
    var key = $(this).attr("id");
    var value = $(this).val();
    editedValues[key] = value;
  });
  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: {
      action: "updateContact",
      contactId: currentContactId,
      updatedValues: editedValues,
    },
    success: function (response) {
      console.log(response);
      alert("Contact mis à jour avec succès!");
    },
    error: function (xhr, status, error) {
      console.log("Erreur Ajax:", xhr.responseText);
      alert("Erreur lors de la mise à jour du contact.");
    },
  });

  closePopup();
}

function updateContactList() {
  $.ajax({
    url: "ajax.php",
    type: "GET",
    data: { action: "getAllContacts" },
    success: function (response) {
        $('#contacts-list').empty();
        $('#contacts-list').html(response);
        console.log(response);
    },
    error: function (xhr, status, error) {
      console.log("Erreur Ajax:", error);
    },
  });
}

function addContact() {
  var newContactData = {
    nom: $("#nom").val(),
    prenom: $("#prenom").val(),
    categorie: $("#categorie").val(),
  };

  $.ajax({
    url: "ajax.php",
    type: "POST",
    data: { action: "addContact", contactData: newContactData },
    success: function (response) {
        updateContactList()
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.log("Erreur Ajax:", error);
    },
  });
  closeAddContactPopup();
}
