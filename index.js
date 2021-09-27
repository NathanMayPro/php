function requestDataMovie() {
  $.post(
    "/services/requestDataMovie.php",
    { title: $("#title").text() },
    (data) => {
      data = JSON.parse(data);
      $("#category").text("Catégorie : " + data["genre"]);
      $("#duration")
        .text("Duration : " + data["duration"])
        .append(" min");
      $("#director").text("Director : " + data["director"]);
      $("#actors")
        .text("Actors : " + data["actors"].split(",").slice(0, 3))
        .append(" ...");
      $("#description").text("Description : " + data["description"]);
      $("#financialProductionCompany").text(
        "Production company : " + data["production_company"]
      );
      $("#financialBudget").text("Budget : " + data["budget"]);
      $("#financialIncomeUsa").text("Income USA : " + data["usa_gross_income"]);
      $("#financialIncomeWordlwide").text(
        "Income Worldwide : " + data["worlwide_gross_income"]
      );
      $("#participantsWriter").text("Writer : " + data["writer"]);
      $("#participantsMainActor").text(
        "Main Actor : " + data["actors"].split(",")[0]
      );
      $("#participantsActors").text(
        "Actors : " + data["actors"].split(",").slice(1, 5)
      );
      $("#notationMetascore").text("Metascore : " + data["metascore"]);
      $("#notationReviewsFromUsers").text(
        "Reviews from users : " + data["reviews_from_users"]
      );
      $("#notationReviewsFromCritics").text(
        "Revews from critics : " + data["reviews_from_critics"]
      );
    }
  );
}

function requestDataProductionCompany() {
  $.post(
    "requestProductionCompany.php",
    { production_company: $("#productionCompany").text() },
    (data) => {
      data = JSON.parse(data);
      $("#lastMovie").text("Last movie produced : " + data[0]);
      $("#movieCount").text("Number of Movie produced: " + data[1]);
      $("#totalProduce").text(
        "Total produced : " + Math.round(data[2] / 60, 2) + " in hour"
      );
    }
  );
}

function requestSearchMovies() {
  $("#search-user").keyup((data) => {
    $("#search-result").html("");

    var searched = data.target.value;
    //console.log(searched);
    if (searched != "") {
      $.ajax({
        type: "GET",
        url: "http://cinemaproject/services/requestSearchMovies",
        data: "data=" + searched,
        context: this,
        success: function (data) {
          if (data != "") {
            console.log(JSON.parse(data));
            $("#search-result").html("");
            data = JSON.parse(data);
            var count = 0;
            data.forEach((d) => {
              if ($("#answer" + count).text() !== d) {
                $("#search-result").append(
                  "<p id = 'answer" + count + "'>" + d + "</p>"
                );
                $("#answer" + count).click(() => {
                  $("#title").text(d);
                  $("#search-user").val("");
                  $("#search-result").html("");
                  requestDataMovie();
                });
              }
              count += 1;
            });
          } else {
            $("#search-result").html("<p>Nothing found</p>");
          }
        },
      });
    }
  });
}

function activePages() {
  $(".activePage").html("");
  switch (activePage) {
    case "Movie":
      $.get("http://cinemaproject/htmlPages/Movie.html", function (result) {
        $(".activePage").html(result);
      });
      activePageMovie();
      break;

    case "Account":
      $.get("http://cinemaproject/htmlPages/Account.html", function (result) {
        $(".activePage").html(result);
      });
      activePageAccount();
      break;

    case "Production":
      $.get(
        "http://cinemaproject/htmlPages/Production.html",
        function (result) {
          $(".activePage").html(result);
        }
      );
      activePageProduction();
      break;

    case "Actor":
      $.get("http://cinemaproject/htmlPages/Actor.html", function (result) {
        $(".activePage").html(result);
      });
      activePageActor();
      break;
  }
}

function activePageAccount() {}

function activePageProduction() {
  requestDataProductionCompany();
}
function activePageActor() {}

function activePageMovie() {
  requestSearchMovies();
}

//Account
function activePageAccount() {
  var pseudo = $("#pseudo").text();
  var email = $("#email").text();
  var password = $("#password").text();
  var confirm = $("#confirm").text();
  console.log(pseudo, email, password, confirm);
}

var activePage = "Movie";

function initialization() {
  $("#MovieButton").click(() => {
    activePage = "Movie";
    activePages();
  });
  $("#ActorButton").click(() => {
    activePage = "Actor";
    activePages();
  });
  $("#ProductionCompanyButton").click(() => {
    activePage = "Production";
    activePages();
  });
  $("#AccountButton").click(() => {
    activePage = "Account";
    activePages();
  });
  $("#search-user").click(() => {
    activePage = "Movie";
    activePages();
  });
}

$(document).ready(() => {
  initialization();
  activePages();
});
