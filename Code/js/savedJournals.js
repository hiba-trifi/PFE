$(document).ready(function () {
    // Filters
    loadJournals("all");
    $("#allBtn").click(function () {
      console.log("All button clicked");
      loadJournals("all");
    });
  
  
    $("#LikedBtn").click(function () {
      console.log("LikedBtn clicked");
      loadJournals("liked");
    });
  
    $("#savedrBtn").click(function () {
      console.log("saved clicked");
      loadJournals("saved");
    });
  
    function loadJournals(filter) {
      $.ajax({
        url: "savedJournals.php",
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
        "savedJournals.php",
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
        "savedJournals.php",
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
  