function updateNavbar() {
    const user = JSON.parse(localStorage.getItem("user"));

    $(".auth-only, .admin-only, .guest-only").hide();

    if (!user) {
        $(".guest-only").show();
        return;
    }

    $(".auth-only").show();

    if (user.role === "admin") {
        $(".admin-only").show();
    }
}

$(document).ready(function () {
    updateNavbar();
});
