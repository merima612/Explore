$(document).ready(function () {
    var app = $.spapp({
        defaultView: "home", // which view loads first
        templateDir: "views/" // where view files are stored
    });

    // define routes for each view
    app.route({
        view: "home",
        load: "home.html"
    });

    app.route({
        view: "about",
        load: "about.html"
    });

    app.route({
        view: "accommodation",
        load: "accommodation.html"
    });

    app.route({
        view: "booking",
        load: "booking.html"
    });
    app.route({
        view: "destination",
        load: "destination.html"
    });
    app.route({
        view: "apartments",
        load: "apartments.html"
    });

    app.route({
        view: "apartment1",
        load: "apartment1.html"
    });

    app.route({
        view: "apartment2",
        load: "apartment2.html"
    });

    app.route({
        view: "camping",
        load: "camping.html"
    });

    app.route({
        view: "camp1",
        load: "camp1.html"
    });

    app.route({
        view: "hotels",
        load: "hotels.html"
    });

    app.route({
        view: "hotel1",
        load: "hotel1.html"
    });

    app.route({
        view: "hotel2",
        load: "hotel2.html"
    });

    app.route({
        view: "hotel3",
        load: "hotel3.html"
    });

    app.route({
        view: "mountainhut",
        load: "mountainhut.html"
    });

    app.route({
        view: "mountainhut1",
        load: "mountainhut1.html"
    });
        app.route({
        view: "login",
        load: "login.html"
    });
        app.route({
        view: "register",
        load: "register.html"
    });

    app.run();
});