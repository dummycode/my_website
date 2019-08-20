$(function() {
  $("#sms__form").submit(function() {
    $("#sms__form")
      .find("input[type=submit]")
      .prop("disabled", true);
    sendMessage();
    return false;
  });

  $(".sms__message-field").prop("maxlength", "80");
  $(".sms__message-field").bind("input propertychange", function() {
    $("#sms__message-field-count").text(
      `${$(".sms__message-field").val().length}/160`
    );
  });

  // Populate contact list
});

function sendMessage() {
  $.ajax({
    url: "http://localhost:3000/api/messages/",
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
