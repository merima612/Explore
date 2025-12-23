$(document).ready(function () {
  updateNavbar();
});

function updateNavbar() {
  const user = JSON.parse(localStorage.getItem("user"));

  $(".guest-only").hide();
  $(".auth-only").hide();
  $(".admin-only").hide();


  if (!user) {
    $(".guest-only").show();
    return;
  }

 
  if (user.role === "user") {
    $(".auth-only").show();
    return;
  }

  
  if (user.role === "admin") {
    $(".auth-only").show();
    $(".admin-only").show();
    return;
  }
}

$(document).on("click", ".logout", function (e) {
  e.preventDefault();
  localStorage.removeItem("user");
  localStorage.removeItem("jwt_token");
  updateNavbar();
  $("#login-form")[0]?.reset();
  window.location.hash = "#login";
});
