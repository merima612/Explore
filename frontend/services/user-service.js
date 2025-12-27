var UserService = {
    init: function () {
        $(document).on("submit", "#registerForm", function (e) {
            e.preventDefault();
            var entity = Object.fromEntries(new FormData(this).entries());
            delete entity.confirmPassword;
            UserService.register(entity);
        });
    },

    register: function(entity) {
        entity.role = 'user';
        RestClient.post("user", entity).then(function(response) {
            toastr.success("Success!");
            window.location.hash = "#login";
        }).catch(function(err) {
            console.error(err);
            toastr.error("Check console for CORS/Database error.");
        });
    },

    // Dodajemo ove prazne funkcije da ti konzola ne bude crvena
    generateMenuItems: function() {
        console.log("Menu generated");
    },
    
    login: function(entity) {
        // Tvoj login kod
    }
};