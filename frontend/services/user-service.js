var UserService = {
    init: function () {
        this.updateNavbar();

        $("#registerForm").validate({
            rules: {
                name: { required: true, minlength: 3 },
                email: { required: true, email: true },
                password: { required: true, minlength: 8 },
                confirmPassword: { required: true, equalTo: "#registerPassword" }
            },
            messages: {
                name: "Please enter your full name (min 3 characters)",
                email: "Please enter a valid email address",
                password: "Password must be at least 8 characters long",
                confirmPassword: "Passwords do not match!"
            },
            submitHandler: function(form) {
                var entity = Object.fromEntries(new FormData(form).entries());
                delete entity.confirmPassword;
                UserService.register(entity);
            }
        });

    
        $("#login-form").validate({
            rules: { 
                email: { required: true, email: true },
                password: { required: true }
            },
            errorPlacement: function (error, element) {
                // Postavlja grešku nakon parent div-a da bude preglednije
                error.insertAfter(element); 
            },
            submitHandler: function(form) { 
                var entity = Object.fromEntries(new FormData(form).entries());
                UserService.login(entity);
            }
        });
    },
    register: function (entity) {
        $.blockUI({ message: '<h5>Registering...</h5>' }); // Dodano blokiranje UI-a
        entity.role = 'user';
        RestClient.post("user", entity).then(function (response) {
            $.unblockUI();
            toastr.success("Success!");
            window.location.hash = "#login";
        }).catch(function (err) {
            $.unblockUI();
            toastr.error("Registration failed.");
        });
    },

    login: function (entity) {
        $.blockUI({ message: '<h5>Logging in...</h5>' }); // Dodano blokiranje UI-a
        RestClient.post("auth/login", entity).then(function (response) {
            $.unblockUI();
            var userData = response.data;
            localStorage.setItem("user_token", userData.token);
            localStorage.setItem("user", JSON.stringify(userData));

            toastr.success("Success! Welcome back.");
            UserService.updateNavbar();

            if (userData.role === 'admin') {
                window.location.hash = "#home1";
            } else {
                window.location.hash = "#home";
            }
        }).catch(function (err) {
            $.unblockUI();
            toastr.error("Invalid email or password");
        });
    },
    updateNavbar: function () {
        var user = JSON.parse(localStorage.getItem("user"));
        $(".guest-only, .auth-only, .admin-only").hide();

        if (user && user.role) {
            $(".auth-only").show();
            if (user.role === 'admin') $(".admin-only").show();
        } else {
            $(".guest-only").show();
        }
    },

    getAllUsers: function() {
    if ($.fn.DataTable.isDataTable('#users-table')) {
        $('#users-table').DataTable().destroy();
    }

    $('#users-table').DataTable({
        ajax: {
            url: "http://localhost/Explore-milestone1/Explore/backend/user",
            type: "GET",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('user_token'));
            },
            dataSrc: "",
            error: function(xhr, status, error) {
                console.error("Greška pri učitavanju korisnika:", error);
                toastr.error("Could not load users. Check console.");
            }
        },
        columns: [
            { data: "user_id" },
            { data: "name" },
            { data: "email" },
            { data: "role" },
            { data: "date_joined" }
        ]
    });
},

    logout: function () {
        localStorage.clear();
        
        
        if ($("#login-form").length) {
            $("#login-form")[0].reset();
        }

        toastr.info("Logged out successfully.");
        UserService.updateNavbar();
        window.location.hash = "#home";
    }
};