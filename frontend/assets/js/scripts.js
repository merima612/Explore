window.addEventListener('DOMContentLoaded', event => {
    // Funkcija za skupljanje navbar-a pri skrolu
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) return;
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink');
        } else {
            navbarCollapsible.classList.add('navbar-shrink');
        }
    };

    navbarShrink();
    document.addEventListener('scroll', navbarShrink);

    // ScrollSpy za navigaciju
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    }

    // Zatvaranje mobilnog menija na klik linka
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
});

// Upravljanje SimpleLightbox-om kroz SPApp promjene
$(document).on("spapp:changed", function () {
    if (window.simpleLightboxInstance) {
        window.simpleLightboxInstance.destroy();
    }

    if (document.querySelector('#portfolio')) {
        window.simpleLightboxInstance = new SimpleLightbox({
            elements: '#portfolio a.portfolio-box',
            captions: true,
            captionSelector: 'self',
            captionType: 'attr',
            captionsData: 'title',
            captionDelay: 250,
        });
    }
});

// Modalni prozor i Booking logika
document.addEventListener('click', function (e) {
    const target = e.target.closest('.portfolio-box');
    if (!target) return;

    const activity = target.getAttribute('data-activity');
    const accommodation = target.getAttribute('data-accommodation');
    const date = target.getAttribute('data-date');
    const location = target.getAttribute('data-location');
    const price = target.getAttribute('data-price');
    const description = target.getAttribute('data-description') || "Includes breakfast and free Wi-Fi.";
    const bookingLink = target.getAttribute('data-booking') || "#booking";

    if(document.getElementById('modalActivity')) {
        document.getElementById('modalActivity').textContent = activity;
        document.getElementById('modalAccommodation').textContent = accommodation;
        document.getElementById('modalDate').textContent = date;
        document.getElementById('modalLocation').textContent = location;
        document.getElementById('modalPrice').textContent = price || "Price on request";
        document.getElementById('modalDescription').textContent = description;
    }

    const bookButton = document.getElementById('bookNowButton');
    if(bookButton) bookButton.setAttribute('href', bookingLink);
});

// Globalni event za Logout (Delegacija da izbjegnemo null greške)
$(document).on("click", "#logoutBtn", function (e) {
    e.preventDefault();
    UserService.logout();
});

// SPApp zaštita ruta (Auth Guard)
$(document).on("spapp:page", function (e, page) {
    const token = localStorage.getItem("user_token");

    // Dozvoljene stranice bez login-a
    if (page === "login" || page === "register" || page === "home") return;

    // Ako nema tokena, baci na login
    if (!token) {
        window.location.hash = "#login";
        return;
    }

    // Provjera role za Admin listu
    try {
        const user = Utils.parseJwt(token).user;
        if (page === "users" && user.role !== "admin") {
            toastr.error("Access denied. Admins only.");
            window.location.hash = "#home";
        }
    } catch (err) {
        localStorage.clear();
        window.location.hash = "#login";
    }
});