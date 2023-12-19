$(document).ready(function () {
  const reload = () => {
    setTimeout(() => {
      window.location.reload();
    }, 2000);
  };

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

  // File
  // Edit File
  $(".btnEditFile").click(function (e) {
    e.preventDefault();
    $("#editFileName").val($(this).data("name"));
    $("#editNotes").val($(this).data("notes"));
    $("#editTags").val($(this).data("tags"));
    $("#EditFileId").val($(this).data("id"));

    $("#editFileModal").modal("show");
  });

  $("#btnCloseEditFileModal").click(function (e) {
    e.preventDefault();
    closeModal("editFileModal");
  });

  $("#frmEditFile").submit(function (e) {
    e.preventDefault();
    var fileId = $("#EditFileId").val();
    var name = $("#editFileName").val();
    var notes = $("#editNotes").val();
    var tags = $("#editTags").val();
    var userId = $("#userId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultyEditSharedFiles",
        fileId: fileId,
        userId: userId,
        fileName: name,
        notes: notes,
        tags: tags,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "File edited!");
          reload;
        } else {
          alert("alert-danger", "Something went wrong.");
        }
      },
    });
  });

  $("#frmEditUser").submit(function (e) {
    e.preventDefault();
    var userId = $("#userId").val();
    var name = $("#editName").val();
    var email = $("#editEmail").val();
    var username = $("#editUsername").val();
    var password = $("#editPassword").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultyEditAccount",
        userId: userId,
        name: name,
        email: email,
        username: username,
        password: password,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "Account edited!");
          reload();
        } else {
          alert("alert-danger", "Something went wrong.");
        }
      },
    });
  });
});
