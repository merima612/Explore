$(document).ready(function () {

  $("#login-form").on("submit", function (e) {
    e.preventDefault();

    const email = $("#email").val();
    const password = $("#password").val();

    if (email === "admin@test.com" && password === "admin1234") {
      localStorage.setItem("user_role", "admin");
      localStorage.setItem("user_email", email);

      toastr.success("Welcome admin!");
      window.location.href = "index.html";
      return;
    }

    if (email === "user@test.com" && password === "user1234") {
      localStorage.setItem("user_role", "user");
      localStorage.setItem("user_email", email);

      toastr.success("Welcome!");
      window.location.href = "index.html";
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
