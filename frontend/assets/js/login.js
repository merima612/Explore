$(document).ready(function () {

  $("#login-form").on("submit", function (e) {
    e.preventDefault();

    const email = $("#email").val();
    const password = $("#password").val();

    if (email === "admin@test.com" && password === "admin1234") {

      localStorage.setItem("user", JSON.stringify({
        email: email,
        role: "admin"
      }));
      localStorage.setItem("justLoggedIn", "true");
      updateNavbar(); 
      toastr.success("Welcome admin!");
      window.location.hash = "#home1";
      return;
    }

    if (email === "user@test.com" && password === "user1234") {

      localStorage.setItem("user", JSON.stringify({
        email: email,
        role: "user"
      }));
      localStorage.setItem("justLoggedIn", "true");
      updateNavbar(); 
      toastr.success("Welcome!");
      window.location.hash = "#home1";
      return;
    }
    toastr.error("Invalid email or password");
  });
  

});

function toggleAdminCredentials() {

    document.getElementById('userCredentials').style.display = 'none';
    

    const adminCreds = document.getElementById('adminCredentials');
    if (adminCreds.style.display === 'none') {
        adminCreds.style.display = 'block';
        adminCreds.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
        adminCreds.style.display = 'none';
    }
}

function toggleUserCredentials() {

    document.getElementById('adminCredentials').style.display = 'none';
    
    const userCreds = document.getElementById('userCredentials');
    if (userCreds.style.display === 'none') {
        userCreds.style.display = 'block';
        userCreds.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
        userCreds.style.display = 'none';
    }
}

function hideAdminCreds() {
    document.getElementById('adminCredentials').style.display = 'none';
}

function hideUserCreds() {
    document.getElementById('userCredentials').style.display = 'none';
}
