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
    var journalId = $(this).data("journal-id");
    var likeCountSpan = $(this).siblings(".like-count"); 

    $.post(
      "journals.php",
      {
        journalId: journalId,
        like: true,
      },
      function (response) {
        console.log(response);
        var currentLikeCount = parseInt(likeCountSpan.text());
        if (response === "liked") {
          likeCountSpan.text(currentLikeCount + 1);
        } else {
          likeCountSpan.text(currentLikeCount - 1);
        }
      
      }
    );
  });   
  
  $(document).on("click", ".save-button", function (e) {
    e.preventDefault();
    var journalId = $(this).data("journal-id");

    $.post(
      "journals.php",
      {
        journalId: journalId,
        save: true,
      },
      function (response) {
        console.log(response);
      }
    );
  });
});
