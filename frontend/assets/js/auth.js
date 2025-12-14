function getCurrentUser() {
    return JSON.parse(localStorage.getItem("user"));
}

function isLoggedIn() {
    return !!localStorage.getItem("user");
}

function isAdmin() {
    const user = getCurrentUser();
    return user && user.role === "admin";
}

