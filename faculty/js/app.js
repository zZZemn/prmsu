$(document).ready(function () {
  const alert = (alertType, text) => {
    $(".alert").addClass(alertType).css("opacity", "1").text(text);
    setTimeout(() => {
      $(".alert").removeClass(alertType).css("opacity", "0").text("");
    }, 2000);
  };

  const closeModal = (modalId) => {
    $("#" + modalId + " input").val("");
    $("#" + modalId).modal("hide");
  };

  // Message
  $("#frmSendMessage").submit(function (e) {
    e.preventDefault();
    var message = $("#txtSendMessage").val();
    var userId = $("#userId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultySendMessage",
        message: message,
        userId: userId,
      },
      success: function (response) {
        console.log(response);
        $("#txtSendMessage").val("");
        if (response != "200") {
          alert("alert-danger", "Can't send a message right now.");
        }
      },
    });
  });
});
