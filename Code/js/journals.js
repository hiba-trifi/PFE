$(document).ready(function () {
  // Filters
  loadJournals("all");
  $("#allBtn").click(function () {
    console.log("All button clicked");
    loadJournals("all");
  });

  $("#latestBtn").click(function () {
    console.log("latestBtn clicked");
    loadJournals("latest");
  });

  $("#mostLikedBtn").click(function () {
    console.log("mostLikedBtn clicked");
    loadJournals("mostLiked");
  });

  $("#popularBtn").click(function () {
    console.log("popularBtn clicked");
    loadJournals("popular");
  });

  function loadJournals(filter) {
    $.ajax({
      url: "journals.php",
      method: "POST",
      data: { filter: filter },
      success: function (response) {
        console.log(response);
        $(".journals").html($(response).find(".journals").html());
      },
    });
  }

  
  // Like and Save
  $(document).on("click", ".like-button", function (e) {
    e.preventDefault();
    var likeButton = $(this);
    var journalId = likeButton.data("journal-id");
    var likeCountSpan = likeButton.siblings(".like-count");
  
    $.post(
      "journals.php",
      {
        journalId: journalId,
        like: true,
      },
      function (response) {
        console.log(response);
  
        if (likeButton.find("i").hasClass("fa-solid")) {
          likeButton.find("i").removeClass("fa-solid").addClass("fa-regular");
          likeCountSpan.text(parseInt(likeCountSpan.text()) - 1);
        } else {
          likeButton.find("i").removeClass("fa-regular").addClass("fa-solid");
          likeCountSpan.text(parseInt(likeCountSpan.text()) + 1);
        }
      }
    );
  });
  
  $(document).on("click", ".save-button", function (e) {
    e.preventDefault();
    var saveButton = $(this);
    var journalId = saveButton.data("journal-id");
    var saveCountSpan = saveButton.siblings(".save-count");
  
    $.post(
      "journals.php",
      {
        journalId: journalId,
        save: true,
      },
      function (response) {
        console.log(response);
  
        if (saveButton.find("i").hasClass("fa-solid")) {
          saveButton.find("i").removeClass("fa-solid").addClass("fa-regular");
          saveCountSpan.text(parseInt(saveCountSpan.text()) - 1);
        } else {
          saveButton.find("i").removeClass("fa-regular").addClass("fa-solid");
          saveCountSpan.text(parseInt(saveCountSpan.text()) + 1);
        }
      }
    );
  });
  


});
