const baseUrl = "http://localhost:3000";

$(function() {
  $("#sms__form").submit(function() {
    $("#sms__form")
      .find("input[type=submit]")
      .prop("disabled", true);
    sendMessage();
    return false;
  });

  $("#sms__form--contact").submit(function() {
    $("#sms__form--contact")
      .find("input[type=submit]")
      .prop("disabled", true);
    createContact();
    return false;
  });

  $(".sms__message-field").prop("maxlength", "160");
  $(".sms__message-field").bind("input propertychange", function() {
    $("#sms__message-field-count").text(
      `${$(".sms__message-field").val().length}/160`
    );
  });

  // Populate contact list
  if ($(".sms-contacts__list").length) {
    $.ajax({
      url: baseUrl + "/api/contacts",
      type: "get",
      data: [],
      success: function(response) {
        $("#sms-contacts__loading").hide();
        const contacts = response.content.data;

        if (contacts.length === 0) {
          $(".sms-contacts__list").replaceWith(
            $("<p>").text("No contacts found")
          );
        }

        contacts.forEach(function(contact) {
          const newContactListItem = renderContactListItem(contact);

          $(".sms-contacts__list").append(newContactListItem);
        });
      },
      error: function(response) {
        $("#sms-contacts__loading").hide();
        alert(
          "Failed to fetch contacts: " + response.responseJSON.content.message
        );
      }
    });
  }
});

function sendMessage() {
  $.ajax({
    url: baseUrl + "/api/messages",
    type: "post",
    data: $("#sms__form").serialize(),
    success: function() {
      $(".sms__form-result")
        .text("Successfully sent message")
        .show();
      $("#sms__form")
        .find("input[type=text], textarea")
        .val("");
      $("#sms__message-field-count").text("0/160");
      $("#sms__form")
        .find("input[type=submit]")
        .prop("disabled", false);
      setTimeout(function() {
        $(".sms__form-result").hide();
      }, 5000);
    },
    error: function() {
      $(".sms__form-result")
        .text("Failed to send message")
        .show();
      $("#sms__form")
        .find("input[type=submit]")
        .prop("disabled", false);
    }
  });
}

function createContact() {
  $.ajax({
    url: baseUrl + "/api/contacts",
    type: "post",
    data: $("#sms__form--contact").serialize(),
    success: function(response) {
      const contact = response.content.data;

      const newContactListItem = renderContactListItem(contact);
      $(".sms-contacts__list").prepend(newContactListItem);

      $("#sms__form--contact")
        .find("input[type=text], textarea")
        .val("");
      $("#sms__form--contact")
        .find("input[type=submit]")
        .prop("disabled", false);

      $(".sms-contacts__list").prepend();
    },
    error: function(response) {
      $(".sms__form-result")
        .text(
          "Failed to create contact: " + response.responseJSON.content.message
        )
        .show();
      $("#sms__form--contact")
        .find("input[type=submit]")
        .prop("disabled", false);
    }
  });
}

function deleteContactHandler(event) {
  deleteContact(
    $(this)
      .parent()
      .data("id")
  );
}

function deleteContact(id) {
  $.ajax({
    url: baseUrl + "/api/contacts/" + id,
    type: "delete",
    data: [],
    success: function() {
      window.location.replace("/beta/sms/contacts");
    },
    error: function(response) {
      alert(
        "Failed to delete contact: " + response.responseJSON.content.message
      );
    }
  });
}

function renderContactListItem(contact) {
  const newListItem = $("<li>").data("id", contact.id);
  const deleteButton = $("<button>")
    .html("Delete")
    .addClass("sms-contacts__remove-button")
    .click(deleteContactHandler);

  newListItem.text(`${contact.name} - ${contact.phone_number}`);
  newListItem.append(deleteButton);

  return newListItem;
}
