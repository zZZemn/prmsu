$(document).ready(function () {
  $(document).on("click", function (e) {
    // Check if the clicked element is not a .btn-toggle-section-menu
    if (!$(e.target).closest(".btn-toggle-section-menu").length) {
      $(".section-menu-container").hide();
    }
  });

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

  // Section
  $("#btnCreateNewSection").click(function (e) {
    e.preventDefault();
    $("#addSectionModal").modal("show");
  });

  $("#btnCloseAddSectionModal").click(function (e) {
    e.preventDefault();
    closeModal("addSectionModal");
  });

  $("#frmAddNewSection").submit(function (e) {
    e.preventDefault();
    var sectionName = $("#sectionName").val();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "AddNewSection",
        sectionName: sectionName,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "Section Added!");
          closeModal("addSectionModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //   Section Menu
  $(".btn-toggle-section-menu").click(function (e) {
    e.preventDefault();
    $(".section-menu-container").hide();
    $(this).closest(".side-nav-li").find(".section-menu-container").toggle();
  });

  //   Delete Section
  $(".btnDelete").click(function (e) {
    e.preventDefault();
    $("#deleteSectionId").val($(this).data("id"));
    $("#deleteSectionModal").modal("show");
  });

  $("#btnCloseDeleteSectionModal").click(function (e) {
    e.preventDefault();
    closeModal("deleteSectionModal");
  });

  $("#frmDeleteSection").submit(function (e) {
    e.preventDefault();
    var sectionId = $("#deleteSectionId").val();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "DeleteSection",
        sectionId: sectionId,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Section Deleted!");
          closeModal("deleteSectionModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //   Rename Section
  $(".btnRename").click(function (e) {
    e.preventDefault();
    var sectionId = $(this).data("id");
    var sectionName = $(this).data("name");

    $("#renameSectionName").val(sectionName);
    $("#renameSectionId").val(sectionId);

    $("#RenameSectionModal").modal("show");
  });

  $("#btnCloseRenameSectionModal").click(function (e) {
    e.preventDefault();
    closeModal("RenameSectionModal");
  });

  $("#frmRenameSection").submit(function (e) {
    e.preventDefault();
    var sectionId = $("#renameSectionId").val();
    var sectionName = $("#renameSectionName").val();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "RenameSection",
        sectionId: sectionId,
        sectionName: sectionName,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Section Updated!");
          closeModal("RenameSectionModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });
});
