$(document).ready(function () {
    // Filters
    loadJournals("all");
    $("#allBtn").click(function () {
      console.log("All button clicked");
      loadJournals("all");
    });
  
  
    $("#publishedBtn").click(function () {
      console.log("publishedclicked");
      loadJournals("published");
    });
  
    $("#unpublishedBtn").click(function () {
      console.log("unpublished  clicked");
      loadJournals("unpublished");
    });
  
    function loadJournals(filter) {
      $.ajax({
        url: "myjournals.php",
        method: "POST",
        data: { filter: filter },
        success: function (response) {
          console.log(response);
          $(".journals").html($(response).find(".journals").html());
        },
      });
    }
  
  });
  